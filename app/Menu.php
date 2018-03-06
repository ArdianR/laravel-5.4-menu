<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    public $timestamps = true;

    public function MenuUser()
    {
        return $this->belongTo('App\MenuUser');
    }

    public function SubMenu()
    {
        return $this->hasMany('App\SubMenu');
    }
}
