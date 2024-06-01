<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cours extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'title',
        'matier_id',
        'class_id',
        'document',
        'video',
        'image',
        'lien'
    ];

    function matier(){
        return $this->belongsTo(Matier::class);
    }
}
