<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    protected $table = 'classe';
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'niveau_id'

    ];
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    public function etudiant(){
        return $this->hasMany(Etudiant::class);
    }
    public function teachers(){
        return $this->belongsToMany(Teachers::class,'teacher_classe');
    }
}
