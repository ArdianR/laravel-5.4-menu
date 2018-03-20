<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
	protected $table = 'move';

    protected $fillable = [
        'from_store_id',
        'user_id',
        'area_id',
        'note',
        'status_id',
        'to_store_id',
        'active'
    ];

}
