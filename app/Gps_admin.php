<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gps_admin extends Model
{
    protected $table ='gps_admin';

    protected $fillable = [
        'brand_gps', 'model_gps', 'gps_name', 'waranty_month', 'buy_date', 'sold_to', 'photo', 'description',
    ];
}
