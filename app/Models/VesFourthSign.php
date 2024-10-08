<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesFourthSign extends Model
{
    use HasFactory;
    protected $fillable = [
        'order','sign', 'description','note','ves_third_sign_id','regulation_id'
    ];

    public function thirdSign() {
        return $this->belongsTo(VesThirdSign::class,'ves_third_sign_id');
    }
    
    public function regulation() {

        return $this->belongsTo(Regulation::class);

       }
}
