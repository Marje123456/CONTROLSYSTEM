<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditMachine extends Model
{
    protected $table = "auditmachines";

    use HasFactory;

    protected $fillable =
    [
        'premise_ident',
        'code',
        'note'
    ];
}
