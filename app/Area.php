<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $table = 'area';

    protected $fillable = [
        'name',
        'alias',
        'active'
    ];

    public function DetailUser()
    {
      return $this->hasMany('App\DetailUser');
    }

    public function Store()
    {
      return $this->hasMany('App\Store');
    }

    // public function Areas()
    // {
    //     return $this->hasManyThrough('App\Area','App\DetailUser','area_id','id');
    // }

}
