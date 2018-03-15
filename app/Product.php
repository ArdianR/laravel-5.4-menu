<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'product';

    protected $fillable = [
        'name',
        'active'
    ];

    // public function DetailPop()
    // {
    //     return $this->hasMany('App\DetailPop');
    // }
}
