<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditpremise extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'idc_responsible',
        'ident',
        'note'
    ];
}
