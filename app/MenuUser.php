<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{

    protected $table = 'menu_users';
    public $timestamps = true;

	public function Menu()
	{
	  return $this->hasMany('App\Menu');
	}

    public function User()
    {
        return $this->belongTo('App\User');
    }
}
