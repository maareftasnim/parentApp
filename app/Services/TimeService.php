<?php
namespace App\Services;

use Carbon\Carbon;

class TimeService
{
    public function generateTimeRange($from,$to){
        $time=Carbon::parse($from);
        $timeRange=[];

        do{
            $timeRange[] = [
                'start' => $time->format("H:i"),
                'end' => $time->addMinutes(60)->format("H:i")
            ];
        }while($time->format("H:i")!== $to);

        return $timeRange;
    }
}
