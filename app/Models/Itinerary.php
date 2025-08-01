<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = 
    [
        'id_itinerary', 
        'name', 
        'selectprosecutor',
        'department',
        'city',
        'neighborhood'
    ];
}
