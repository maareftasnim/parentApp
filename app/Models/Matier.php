<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'matiername',
        'coef',
        'niveau_id',
        'module_id'
    ];

    public function niveaux(){
        return $this->belongsToMany(Niveau::class,'niveau_matier');
    }

    public function cours(){
        return $this->belongsToMany(Cours::class);
    }
    public function teachers(){
        return $this->belongsToMany(Teachers::class,'teacher_matier');
    }
    public function modules()
    {
        return $this->belongsTo(Module::class,'module_id');
    }
    public function types()
    {
        return $this->belongsToMany(Typenote::class,'matier_typnote','matier_id','type_id');
    }
}
