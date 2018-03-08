<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    // public function DetailUser()
    // {
    //   return $this->hasMany('App\DetailUser');
    // }

    // public function areas()
    // {
    //     $areas = [];

    //     foreach ($this->DetailUser as $DetailUser) {
    //     $areas[] = $DetailUser->areas;
    //     }

    //     return $areas;
    // }

    public function DetailUser()
    {
        return $this->hasMany('App\DetailUser');
    }

    public function Groups()
    {
        return $this->hasManyThrough('App\Group','App\DetailUser','group_id','id');
    }
    
    public function Areas()
    {
        return $this->hasManyThrough('App\Area','App\DetailUser','area_id','id');
    }
}
