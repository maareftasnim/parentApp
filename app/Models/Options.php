<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Options extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table='options';
    protected $fillable=[
      'points',
      'question_id',
      'option_text',
    ];
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
