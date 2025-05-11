<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaUsage extends Model
{
  
  	protected $table = 'social_media_usage';
    protected $fillable = [
        'user_id',
        'platform',
        'start_time',
        'end_time',
        'duration_seconds'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}

