<?php

namespace App\Models;

use App\Observers\ParentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Parents extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = "parents";
    protected $fillable = [
        'nomP', 'prenomP', 'numtelP', 'metierP',
        'nomM', 'prenomM', 'numtelM', 'metierM',
        'numtelF','numtelS','email','password','status'
    ];
    protected static function boot(){
        parent::boot();
        Parents::observe(ParentObserver::class);

    }
    public function enfants(){
        return $this->hasMany(Etudiant::class,'parent_id');
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
