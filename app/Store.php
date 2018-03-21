<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	protected $table = 'store';

    protected $fillable = [
        'dealer_id',
        'name',
        'address',
        'area_id',
        'grade',
        'active'
    ];

    public function Area()
    {
      return $this->belongsTo('App\Area');
    }

    public function Pop()
    {
      return $this->hasMany('App\Pop');
    }



    public function ProductStore()
    {
      return $this->hasMany('App\ProductStore');
    }
    
    // public function User()
    // {
    //     return $this->hasManyThrough('App\User','App\Pop','1user_id','id');
    // }

    // public function Group()
    // {
    //     return $this->hasManyThrough('App\Group','App\Pop','group_id','id');
    // }

    // public function Status()
    // {
    //     return $this->hasManyThrough('App\Status','App\Pop','status_id','id');
    // }
}
