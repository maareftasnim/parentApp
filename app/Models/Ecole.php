<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    use HasFactory;
    protected $table='ecole';
    protected $fillable=[
        'name',
        'email',
        'telephone',
        'adress',
        'semestre_id',

    ];
}
