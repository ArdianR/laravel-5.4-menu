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

    public function FromStore()
    {
        return $this->belongsTo('App\Store','from_store_id');
    }

    public function ToStore()
    {
        return $this->belongsTo('App\Store','to_store_id');
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
