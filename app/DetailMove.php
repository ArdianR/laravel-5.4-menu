<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailMove extends Model
{

	protected $table = 'Detail_Move';

    protected $fillable = [
        'move_id',
        'product_id',
        'qty'
    ];

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }

}
