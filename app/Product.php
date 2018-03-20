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

    // public function ProductStore()
    // {
    //     return $this->belongsTo('App\ProductStore','product_id');
    // }
}
