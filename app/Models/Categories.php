<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table='categories';
    protected $fillable=[
        'name',
        'class_id',
        'teacher_id'
    ];
    public function categoryQuestions()
    {
        return $this->hasMany(Question::class, 'category_id', 'id');
    }


}
