<?php
namespace App\Services;

use App\Models\Days;
use App\Models\Seances;
use Illuminate\Http\Request;


class  CalendarService
{
    public function generateCalendarData($weekDays,$id)
    {
        $calendarData=[];
        $timeRange=(new TimeService)->generateTimeRange(config('app.calendar.start_time'),config('app.calendar.end_time'));
        $lessons=Seances::with('class','teacher','salle','emploi')->get();


        foreach ($timeRange as $time)
        {
            $timeText=$time['start'].'-'.$time['end'];
            $calendarData[$timeText]=[];
            foreach ($weekDays as $index=>$day){
                $lesson=$lessons->where('day_id',$index+1)->where('start_time',$time['start'])->where('emploi_id',$id)->first();

                if ($lesson)
                {
                    $calendarData[$timeText][] = [
                        'class_name' => $lesson->class->title,
                        'matier_name' => $lesson->matier->matiername,
                        'salle_name'=>$lesson->salle->sallename,
                        'teacher_name' => $lesson->teacher->firstname,
                        'emploi_id' => $lesson->emploi->id,
                        'seance_id' => $lesson->id,
                        'rowspan' => $lesson->difference / 60 ?? ''
                    ];
                }
                else if (!$lessons->where('day_id',$index+1)->where('start_time','<',$time['start'])->where('end_time','>=',$time['end'])->where('emploi_id',$id)->count())
                {
                    $calendarData[$timeText][] = 1;


                }
                else{
                    $calendarData[$timeText][] = 0;

                }
            }

        }
        return $calendarData;

    }

    public function miseAjourCalendarData($weekDays)
    {

        $calendarData=[];
        $timeRange=(new TimeService)->generateTimeRange(config('app.calendar.start_time'),config('app.calendar.end_time'));
        $lessons=Seances::with('class','teacher','salle')->get();

        foreach ($timeRange as $time)
        {
            $timeText=$time['start'].'-'.$time['end'];
            $calendarData[$timeText]=[];

        }
        return $calendarData;
    }
}
