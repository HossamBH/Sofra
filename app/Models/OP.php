<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OP extends Model 
{

    protected $table = 'order_product';
    public $timestamps = true;
    protected $fillable = array('price','quantity', 'notes');

}