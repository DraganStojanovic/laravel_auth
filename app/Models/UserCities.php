<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCities extends Model
{
    protected $table = 'user_cities';

    protected $fillable = [
        'user_id',
        'city_id', // Pravilno ime strane ključne kolone
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(CitiesModel::class);
    }
}

