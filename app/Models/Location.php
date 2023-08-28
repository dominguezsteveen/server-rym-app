<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type',
        'dimension',
        'residents',
        'url'
    ];

    protected $casts = [
        'residents' => 'array'
    ];

    // Define un accesor para "origin" que devuelve un objeto en lugar de una cadena JSON
    public function getOriginAttribute($value)
    {
        return json_decode($value);
    }
}
