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
}
