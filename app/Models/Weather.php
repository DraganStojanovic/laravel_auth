<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
//    use HasFactory;
    const TABLE = "weather";
    protected $table = self::TABLE;

    protected $fillable = [
        "city_id","temperature",
    ];

}
