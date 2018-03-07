<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{

	protected $table = 'Detail_User';

    public function User()
    {
      return $this->belongTo('App\User');
    }
}
