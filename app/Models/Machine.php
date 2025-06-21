<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
    [
        'premise_ident',
        'code',
        'model',
        'brand',
        'seriale',
        'responsible'
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];
}
