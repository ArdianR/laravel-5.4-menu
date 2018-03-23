<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoMove extends Model
{
	protected $table = 'photo_move';

    protected $fillable = [
        'move_id',
        'type',
        'photo'
    ];
}
