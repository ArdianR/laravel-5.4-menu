<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{

	protected $table = 'Detail_User';

    protected $fillable = [
        'user_id',
        'area_id',
        'group_id'
    ];

    // public function User()
    // {
    //   return $this->belongTo('App\User');
    // }

    // public function Area()
    // {
    //   return $this->hasMany('App\Area','id');
    // }
}
