<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seances extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='seances';
    protected $fillable=[

        'start_time',
        'end_time',
        'class_id',
        'matier_id',
        'salle_id',
        'teacher_id',
        'day_id',
        'emploi_id'
    ];
    function class()
    {
        return $this->belongsTo(Classe::class,'class_id');
    }

    function emploi()
    {
        return $this->belongsTo(Emploi::class,'emploi_id');
    }
    function matier()
    {
        return $this->belongsTo(Matier::class,'matier_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teachers::class,'teacher_id');
    }
    public function salle()
    {
        return $this->belongsTo(Salle::class,'salle_id');
    }
    public function getDifferenceAttribute()
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);

    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
            $value)->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
            $value)->format('H:i:s') : null;
    }

}
