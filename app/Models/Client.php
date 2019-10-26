<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'neighborhood_id', 'pin_code');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    protected $hidden =[
        'password', 'api_token'
    ];

}