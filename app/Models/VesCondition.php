<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesCondition extends Model
{
    use HasFactory;
    protected $fillable = [
        'rb',
        'old_ves',
        'old_alternative',
        'old_kind',
        'old_condition',
        'ves',
        'condition',
        'reading',
        'alternative',
        'regulation_id'
        
    ];
}
