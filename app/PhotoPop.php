<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoPop extends Model
{
	protected $table = 'photo_pop';

    protected $fillable = [
        'pop_id',
        'type',
        'photo'
    ];
}
