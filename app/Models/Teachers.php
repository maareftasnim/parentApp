<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use Spatie\Permission\Traits\HasRoles;

class Teachers extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
   // use HasRoles;
    protected $fillable=[
        'firstname',
        'lastname',
        'email',
        'phoneNumber',
        'password',
        'role_id'
    ];
    public function deleteClass($classId)
    {
        DB::table('teacher_classe')
            ->where('teachers_id', $this->id)
            ->update(['deleted_at' => now()]);
    }
    public function classe(){
        return $this->belongsToMany(Classe::class,'teacher_classe')->withTimestamps()->withPivot('teachers_id')->whereNull('class_teacher.deleted_at');
    }
    public function matiers(){
        return $this->belongsToMany(Matier::class,'teacher_matier');
    }

}
