<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{

	protected $table = 'sub_menus';
    public $timestamps = true;

	public function Menu()
	{
	  return $this->belongTo('App\Menu');
	}
}
