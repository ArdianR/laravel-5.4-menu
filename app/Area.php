<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $table = 'areas';
    public $timestamps = true;

    public function AreaUser()
    {
        return $this->belongTo('App\AreaUser');
    }
}
