<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Niveau extends Model
{
    protected $table = 'niveau';
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'niveauNom',

    ];
    protected $hidden = ['niveauNom'];
    //protected hidden


    //setattribut,getattribut
//etat

/*   protected $classe = [];

    public function hasMany($Class, $foreignKey)
    {
        $this->classe[] = [
            'Class' => $Class,
            'foreignKey' => $foreignKey,
        ];
    }*/

    public function classes()
    {

        return $this->hasMany(Classe::class);


    }

    public function hasOneToTwo($Class, $foreignKey)
    {

        if (count($this->classe) <= 2) {
            $this->classe[] = [
                'Class' => $Class,
                'foreignKey' => $foreignKey,
            ];
        } else {

            echo "La taille maximale du tableau est déjà atteinte.";
        }
    }
    public function etudiant()
    {
        return $this->hasOneToTwo(Parents::class,'parent_id');

    }
    public function teachers(){
        return $this->belongsToMany(Teachers::class,'teacher_niveaux');
    }

    public function matiers(){
        return $this->belongsToMany(Matier::class,'niveau_matier');
    }
}
