<?php

namespace Plans\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany('Plans\Models\Role')->withTimestamps();
    }


    public function hasRole($name)
    {

//        $user = Auth::user();

        foreach (\Auth::user()->roles as $role) {
            if ($role->name == $name) return true;
        }

        return false;
    }

    public function withRole($role)
    {
        return $this->whereHas('roles', function($q) use ($role) {
            $q->where('name', $role);
        })->get();
    }

}
