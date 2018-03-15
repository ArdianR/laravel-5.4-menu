<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPop extends Model
{
	protected $table = 'detail_pop';

    protected $fillable = [
        'pop_id',
        'product_id',
        'qty'
    ];

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
}
