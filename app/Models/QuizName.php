<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizName extends Model
{
    use HasFactory;
    protected $table='quizname';
    protected $fillable=[
      'class_id',
      'name',
      'teacher_id',
    ];

}
