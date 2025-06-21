<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statusmachine extends Model
{
    use HasFactory;

    protected $fillable = ['penalty_days', 'forfeiture_days','porcent_company'];
}
