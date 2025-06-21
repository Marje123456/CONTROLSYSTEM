<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Premise extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
    [
        'idc',
        'name',
        'rut',
        'patent',
        'address',
        'email',
        'phone',
        'coordinates',
        'department',
        'city',
        'neighborhood'
    ];
}
