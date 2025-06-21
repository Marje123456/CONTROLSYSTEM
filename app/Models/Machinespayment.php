<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machinespayment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'code_machine',
        'amount',
        'month_pay'
    ];
}
