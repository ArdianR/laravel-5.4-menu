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

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Group()
    {
        return $this->belongsTo('App\Group');
    }

    public function Area()
    {
        return $this->belongsTo('App\Area');
    }

    public function Store()
    {
        return $this->belongsTo('App\Store');
    }

    public function Status()
    {
        return $this->belongsTo('App\Status');
    }

    // public function DetailPop()
    // {
    //     return $this->belongsTo('App\DetailPop');
    // }

    public function PhotoPop()
    {
        return $this->hasMany('App\PhotoPop');
    }

}
