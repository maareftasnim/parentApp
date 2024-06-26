<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='module';
    protected $fillable=[
      'name',
    ];
    public function matiers(){
        return $this->hasMany(Matier::class);
    }
}
