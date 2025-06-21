<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryProsecutor extends Model
{
    protected $table = "itineraryprosecutors";
    use HasFactory;
    protected $fillable = ['selectprosecutor','selectitinerary'];
}
