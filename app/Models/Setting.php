<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('about_us', 'content', 'text', 'phone', 'email', 'fb_link', 'twitter_link', 'youtube_link', 'whatsapp', 'insta_link', 'commission', 'maximum');

}