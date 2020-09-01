<?php


namespace App\Helpers;


use App\Booking;
use App\Service;
use App\SmsBooking;
use BongaTech\Api\BongaTech;
use BongaTech\Api\Models\Sms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Vtiful\Kernel\Excel;

class Helper
{
    public static function formatNumber($number, $strict = false)
    {
        $number = str_replace(' ', '', $number);
        //
        $first = substr($number, 0, 1);
        if ($first == '+')
            $number = substr($number, 1);

        if (strlen($number) == 12 && !$strict)
            return $number;
        //
        $first = substr($number, 0, 1);
        if ($first == 0)
            $number = substr($number, 1);

        $first254 = substr($number, 0, 3);
        if ($first254 == 254)
            $number = substr($number, 3);

        $number = (int)"254" . $number;

        return $number;
    }

    public static function getNextSeat($min, $max, $service_id, $seat = null)
    {
        if ($seat != null)
            if (!Booking::where('status', Booking::STATUS_APPROVED)->where('service_id', $service_id)
                ->where('seat', $seat)->exists())
                return $seat;
        $range = range($min, $max);
        $seat = -1;
        foreach ($range as $index) {
            if (!Booking::where('status', Booking::STATUS_APPROVED)->where('service_id', $service_id)
                ->where('seat', $index)->exists()) {
                $seat = $index;
                break;
            }

        }
        return $seat;
    }

    public static function exportResponses($query)
    {
        $query = $query->get();
        $excel_config = ['path' => storage_path("app/public/excel")];
        $excel = new Excel($excel_config);
        $file_name = "Export_" . Carbon::now()->format("ymdhis") . ".xlsx";
        $file = $excel->fileName($file_name, "Attendees")
            ->header(['NAME', 'PHONE', 'SEAT', 'STATUS']);
        foreach ($query as $attendee) {
            $file->data([[$attendee->names, $attendee->phone, $attendee->seat, $attendee->decoded_status]]);
        }
        $file->output();
        return $file_name;
    }

    public static function sendQuestion($message, $phone){
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzhkNGNkZTg4NjI2MWE4MDk1OTMwMzY4MjgzNGEyNmYyNWJlYTU0ZmMwNjUwZDg1MjAxY2JkZDFlMTRlYTA0YTE0MzY3M2U0OGUwZmUzYTIiLCJpYXQiOjE1NzkxNjY0ODcsIm5iZiI6MTU3OTE2NjQ4NywiZXhwIjoxNjEwNzg4ODg3LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.FQwNCETcxF_ioP6Klww6OORkvqyzSWUfHh41oxpA8ewOrDQjdGjSnXevH8QZk2xMuQwYih3iXnufSPa64wNICrV-p1_oYkAq1YSQmDspHZ1K9V_ThMa8QwtIX1gDMF3dBOSoo2c3Wsp6ZtTjI2Z9lfJS2cZYbKRfkWLRuJPcHpuexT2sN0JtSf6rAMGcF7-R36n3MamjnmVuuWp1xfaAC-kcYtFSdOUAEh49bRCtKExBkFIiiexIEDL4mNQrMV0fbuXQaY62xNebZEHYH9XgfwJhJ9EmJvwrdL_2X1-FklAeb9rCPONdFEiphPPw6j5kSE9_XqPnJyiA7ylhJgaMiUb-jJ1c28OjVBrQT-nTGNeJmSTM8Sgy7Ill9-SZcKDjv1xatkqNU_xifxOI_syTJPg8Zk1DGMkIbbJ7yJmM8447j0KcY14i0oEPuXjHJNx4-IS0qfOYaBHNdbCfcz8LkP2sFeGHFB9j7b_Ukn6fc8udM80LR8ov0o4O_tUp_CjGBhTFb6TLIX7wto4b7ABLpoz-strgz2iTMtcI0InDR7KTrj2glRXKe12bpBEPVDal7c-PqW8PfTz_SwOEsheeivP-FL-xnfck0gwFT2haQaFyZWFggqgbZmEHjC4RQkwj8UuRki4iXV10n8nmr0gACXwtzt96guhnz3UAC2cj2MU";
        $instance = new BongaTech($token);
        $sms= new Sms("BLUESKY", $phone, $message, "101");
        $response = $instance->sendSMS($sms);
        Log::info($response);
    }

    public static function nextQuestion(SmsBooking $smsBooking){
        if ($smsBooking->status == 0){
            $services = Service::where('status', true)->orderBy('when')->get();
            if ($services){
                $message = "Welcome. Please select a service you wish to attend by replying with: \n";
                foreach ($services as $service){
                    $message .= "$service->id for $service->title($service->when)\n";
                }
            } else
                $message = "No Upcoming Service Available. Please Try again Later!";
            self::sendQuestion($message, $smsBooking->phone);
        } elseif ($smsBooking->status == 1){
            $message = "What is your Name?";
            self::sendQuestion($message, $smsBooking->phone);
        } elseif ($smsBooking->status == 2){
            $message = "Enter your ID Number. (those without ID numbers to input their parent/guardian ID Number)";
            self::sendQuestion($message, $smsBooking->phone);
        } elseif ($smsBooking->status == 3){
            $message = "Enter your Location. (e.g Kikuyu Town)";
            self::sendQuestion($message, $smsBooking->phone);
        } elseif ($smsBooking->status == 4){
            //TODO DO the transfer
            $booking = Booking::create($smsBooking->toArray());
            $booking->update(['status'=>0, 'deck'=>'lower_deck']);
            $smsBooking->update(['status'=>30]);
            $message = "Thank you. Your booking reference is $booking->id. You can send the message validate#$booking->id to see the status of your booking";
            self::sendQuestion($message, $smsBooking->phone);
        }
    }

    public static function validateInbox(SmsBooking $smsBooking, $response){
        if ($smsBooking->status == 0){
            $available_services =  Service::where('status', true)->orderBy('when')->get()->pluck('id')->toArray();
            if (!in_array($response, $available_services)){
                $message = "Invalid Response. Available responses are ".implode(",", $available_services);
                self::sendQuestion($message, $smsBooking->phone);
                return;
            }
            $smsBooking->update(['status'=>$smsBooking->status + 1,
                'service_id'=>$response]);
            self::nextQuestion($smsBooking);
        } elseif ($smsBooking->status == 1){
            $smsBooking->update(['status'=>$smsBooking->status + 1,
                'names'=>$response]);
            self::nextQuestion($smsBooking);
        } elseif ($smsBooking->status == 2){
            if (!ctype_digit($response)){
                $message = "Invalid Response. ID Number should only contain Digits";
                self::sendQuestion($message, $smsBooking->phone);
                return;
            }
            $smsBooking->update(['status'=>$smsBooking->status + 1,
                'id_number'=>$response]);
            self::nextQuestion($smsBooking);
        } elseif ($smsBooking->status == 3){
            $smsBooking->update(['status'=>$smsBooking->status + 1,
                'location'=>$response]);
            self::nextQuestion($smsBooking);
        }
    }
}
