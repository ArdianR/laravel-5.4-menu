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

    // public function DetailUser()
    // {
    //   return $this->belongTo('App\DetailUser');
    // }

}
