<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use ShinobiTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ID_Persona','name', 'email','password','remember_token',
    ];

    protected $casts = [
        'ID_Persona' => 'integer',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
