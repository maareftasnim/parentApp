<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resultat extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='resultat';
    protected $fillable=[
        'total_points',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot(['option_id', 'points']);
    }
}
