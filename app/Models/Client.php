<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // use HasFactory;

    protected $table = 'users';

    protected $fillable=['name','email','password'];

    protected $guarded=[];


    protected $hidden = ['password'];

    public function getJWTIdentifier(){
        return $this->getKey();
    }


    public function getJWTCustomClaims(){
        return [];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
