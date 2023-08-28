<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'status',
        'species',
        'type',
        'gender',
        'origin',
        'location',
        'image',
        'episode',
        'url'
    ];

    protected $casts = [
        'origin' => 'json',
        'location' => 'json',
        'episode' => 'array',
    ];

     // Define un accesor para "origin" que devuelve un objeto en lugar de una cadena JSON
     public function getOriginAttribute($value)
     {
         return json_decode($value);
     }
}
