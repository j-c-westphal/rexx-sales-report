<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Sale extends Model
{
    protected $guarded = [];

    public function getSaleDateFormatedAttribute()
    {
        return Carbon::parse($this->sale_date, 'UTC')->formatLocalized('%e. %B %Y %T');
    }

    public function getSaleDateUnixAttribute()
    {
        return Carbon::parse($this->sale_date, 'UTC')->timestamp;
    }
}
