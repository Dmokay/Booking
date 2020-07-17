<?php


namespace App\Helpers;


use App\Booking;
use Carbon\Carbon;
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

    public static function getNextSeat($min, $max, $seat = null)
    {
        if ($seat != null)
            if (!Booking::where('status', Booking::STATUS_APPROVED)->where('seat', $seat)->exists())
                return $seat;
        $range = range($min, $max);
        $seat = -1;
        foreach ($range as $index) {
            if (!Booking::where('status', Booking::STATUS_APPROVED)->where('seat', $index)->exists()) {
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
            ->header(['NAME', 'PHONE', 'STATUS']);
        foreach ($query as $attendee) {
            $file->data([[$attendee->names, $attendee->phone, $attendee->decoded_status]]);
        }
        $file->output();
        return $file_name;
    }
}
