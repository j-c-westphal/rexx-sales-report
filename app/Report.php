<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['slug'];

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
}
