<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaUser extends Model
{

	public function User()
	{
	  return $this->belongTo('App\User');
	}

	public function Area()
	{
	  return $this->hasMany('App\Area');
	}

}
