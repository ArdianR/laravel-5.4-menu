<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	public function AreaUser()
	{
	  return $this->belongTo('App\AreaUser');
	}
}
