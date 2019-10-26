<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable 
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'image', 'delivery', 'min_charge', 'email', 'phone', 'password','neighborhood_id', 'pin_code', 'status');

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Commission');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function commissions()
    {
        return $this->hasMany('App\Models\Commission');
    }

    protected $hidden =[
        'password', 'api_token'
    ];

}