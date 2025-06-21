<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Closebox extends Model
{
    protected $table = "closeboxes";
    use HasFactory;

    protected $fillable = 
    [
        'close_date', 
        'total_amount',
        'total_cash',
        'total_trans',
        'total_qr'
    ];
}
