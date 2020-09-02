<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['ref', 'name', 'price'];

    public function sales()
    {
        return $this->hasMany('App\Sale');
    }
}
