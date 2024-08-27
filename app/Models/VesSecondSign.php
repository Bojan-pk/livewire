<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesSecondSign extends Model
{
    use HasFactory;
    protected $fillable = [
        'order','sign', 'description','note'
    ];
}
