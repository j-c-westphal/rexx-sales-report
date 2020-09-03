<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
}
