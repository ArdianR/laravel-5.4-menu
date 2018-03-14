<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pop extends Model
{
	protected $table = 'pop';

    protected $fillable = [
        'periode',
        'user_id',
        'area_id',
        'group_id',
        'store_id',
        'posisi',
        'ukuran',
        'note',
        'status_id',
        'active'
    ];
}
