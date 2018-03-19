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
        'password',
        'active'
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
        return $this->hasOne('App\DetailUser');
    }

    // public function Pop()
    // {
    //     return $this->belongsTo('App\Pop','user_id');
    // }

    // public function Area()
    // {
    //     return $this->hasMany('App\Area','id');
    // }

    // public function Group()
    // {
    //     return $this->hasMany('App\Group','id');
    // }

    // public function Pop()
    // {
    //     return $this->hasMany('App\Pop');
    // }
    
    // public function User()
    // {
    //     return $this->hasManyThrough('App\User','App\Pop','id','user_id');
    // }




    
}
