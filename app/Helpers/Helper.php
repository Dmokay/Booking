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
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTgwODNhMTZjMDc5ZTgzZGYxODk2YWEwNmVmZThjMzgzOGE5OGI4YTI0MDYxOTM2NzEwZDZmMWE1ZWM0N2MyYjZmYzI0YTcyN2RkYTA4MzMiLCJpYXQiOjE1OTkwMzc2MjMsIm5iZiI6MTU5OTAzNzYyMywiZXhwIjoxNjMwNTczNjIzLCJzdWIiOiIyMTUiLCJzY29wZXMiOltdfQ.O4pLKZ_nOFeEeDKK5K_KEgCw9GkphIe_rqlDT-WZKosTNclr39G8AoYKZK9X0HB0LyPhWD70eQXW2HZI3LbvKEfx92i5OAmMqMhExKYq6v3mteActv3QvcVRO3teHt-qG0Eif9s3k1vuDKdh_tYz1_leizdx1IVJ3BppCH2kUEWPFqegxQYgyPKTcjJHvvQ1RmjBnalKQLu5OmcWQeqz3_Iy12WQ4qoi6YkCzq_WMVPhKpQv3ww9rA-ef6CRMcXRTg29MdtWyRlpkFkDhWCREBqMYiHH_3ewmhxludlzM3qxeLA_rsL6OeiqRKm7miXipuSFqPg8yXgpwd9rzzQ72U5WE2pR_NKUB2rMtFa8CD8VkyrqIvPljKjAsHJdUoNZ3WTWV4gXSimAqcISc0cF8tY8u3lhq00prlaFrU8WdoKWfSbdcGEQdwOPgmMgmkOIg-wBK56C1Ewe6mMldbETLFOlCaQFkplinD7ycYtHicGiTmSeo0BHU-X5v3M_ae4al6bqQNHeWTmloSoDBAgMUlKFT6pT8MlHkKbjnvVjOcYMPt3weelM-IhJ-2O89WclK_Vs7kVK4bBWtQeQ9rPHurJk-Fh4AnLdRNoBqmcKaY6maLhDMM0BnK6Yd9u-e2P1PmknviX26c8tcJoek2ucEYXLdJnTiSl6aZtgwZ_Ck_8";
        $instance = new BongaTech($token);
        $sms= new Sms("23062", $phone, $message, "101");
        $response = $instance->sendSMS($sms);
        Log::info($response);
    }

    public static function nextQuestion(SmsBooking $smsBooking){
        if ($smsBooking->status == 0){
            $services = Service::where('status', true)->orderBy('when')->get();
            if (count($services) > 0){
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
