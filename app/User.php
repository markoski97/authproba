<?php

namespace App;
use App\Traits\HasRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'stripe_id','stripe_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files(){
        return $this->hasMany(File::class);
    }

    public function isAdmin(){//KO CHE SE POVIKA OVA FUNKCIJA PROVERUVA DALI LOGIRANIO USER E ADMIN SE KORISTI KAJ VO FILE.PHP
        return $this->hasRole('admin1');
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
