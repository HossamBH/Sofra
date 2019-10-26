<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'payment_method_id', 'order_state', 'address', 'price', 'total_price', 'delivery', 'commission', 'notes');

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('price','quantity','notes');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

}