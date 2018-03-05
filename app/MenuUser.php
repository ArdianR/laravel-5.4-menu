<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuUser extends Model
{

	public function User()
	{
	  return $this->belongTo('App\User');
	}

	public function SubMenu()
	{
	  return $this->hasMany('App\SubMenu');
	}
}
