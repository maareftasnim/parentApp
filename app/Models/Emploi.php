<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Table;

class Emploi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='emploi';
    protected $fillable=[
        'name',
        'class_id',
    ];
    public function seances(){
        return $this->hasMany(Seances::class);
    }
}
