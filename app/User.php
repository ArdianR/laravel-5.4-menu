<?php

namespace App;

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
        'name', 'email', 'password',
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
    public $timestamps = true;

    public function AreaUser()
    {
        return $this->hasMany('App\AreaUser');
    }

    public function Areas()
    {
        return $this->hasManyThrough(
            'App\Area','App\AreaUser',
            'user_id','id'
        );
    }

    public function MenuUser()
    {
        return $this->hasMany('App\MenuUser');
    }

    public function Menus()
    {
        return $this->hasManyThrough(
            'App\Menu','App\MenuUser',
            'menu_id','id'
        );
    }

    public function SubMenus()
    {
        return $this->hasManyThrough(
            'App\Menu','App\SubMenu',
            'menu_id','id'
        );
    }

}
