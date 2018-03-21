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

    public function Store()
    {
        return $this->belongsTo('App\Store');
    }

    public function Area()
    {
        return $this->belongsTo('App\Area');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Status()
    {
        return $this->belongsTo('App\Status');
    }

}
