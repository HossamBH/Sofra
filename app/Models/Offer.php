<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'start', 'end', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}