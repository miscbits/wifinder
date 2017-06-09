<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    public $table = "hotspots";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'city',
		'place',
		'ssid',
		'password',
    
    ];

    public static $rules = [
        // create rules
    ];
    // Hotspot 
}
