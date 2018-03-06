<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaUser extends Model
{

    protected $table = 'area_users';
    public $timestamps = true;

    public function User()
    {
        return $this->belongTo('App\User');
    }

    public function Areas()
    {
        return $this->hasMany('App\Area');
    }

}
