<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model 
{

    protected $table = 'commissions';
    public $timestamps = true;
    protected $fillable = array('paid', 'restaurant_id', 'payment_date');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}