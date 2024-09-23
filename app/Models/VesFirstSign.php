<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesFirstSign extends Model
{
    use HasFactory;
    protected $fillable = [
        'order','sign', 'description','note','regulation_id','rules'
    ];

    public function regulation() {

        return $this->belongsTo(Regulation::class);

       }
}
