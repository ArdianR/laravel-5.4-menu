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

    // public function Groups()
    // {
    //     return $this->hasManyThrough('App\Group','App\DetailUser','group_id','id');
    // }
    

    // public function User()
    // {
    //   return $this->belongToMany('App\User');
    // }

    // public function Area()
    // {
    //   return $this->hasManyThrough('App\Area','App\User');
    // }

    // public function User()
    // {
    //   return $this->belongsTo('App\User');
    // }

    public function Area()
    {
      return $this->belongsTo('App\Area');
    }
    public function Group()
    {
      return $this->belongsTo('App\Group');
    }
}
