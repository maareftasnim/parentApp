<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etudiant extends Model
{

    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'class_id',
        'niveau_id' ,
        'parent_id',
        'avatar',
    ];
//softDelete

public function classe(){

    return $this->belongs(Classe::class);

}
public function niveau(){

    return $this->belongs(Niveau::class);

}

public function parents(){
    return $this->belongsTo(Parents::class);
}

/*public function convocations(){
    return $this->belongsToMany(Convocation::class,'convocation_etudiants');
}*/
    public function convocations(){
        return $this->hasMany(Convocation::class);
    }

    public function travail(){
        $this->belongsToMany(Travail::class,'travail_etudiant');
    }
    public function userResults()
    {
        return $this->hasMany(Resultat::class, 'user_id', 'id');
    }
}
