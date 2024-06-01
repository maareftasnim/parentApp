<?php

namespace App\Models;

use App\Category;
use App\Option;
use App\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table='questions';

    protected $fillable=[
        'category_id',
        'question_text',
        'time'
    ];
    public function questionOptions()
    {
        return $this->hasMany(Options::class, 'question_id', 'id');
    }

    public function questionsResults()
    {
        return $this->belongsToMany(Resultat::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
