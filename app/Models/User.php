<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'resp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        if( $this->role == 0 ){
            return true;
        }
    }
    public function isDispatcher(){
        if($this->role == 1){
            return true;
        }
    }
    public function isAsman(){
        if($this->role == 2){
            return true;
        }
    }

    public function isPusat(){
        if($this->role == 3){
            return true;
        }
    }

    public function pool(){
        return $this->belongsTo(Pool::class, 'resp', 'pool');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'resp', 'kode_area');
    }
}
