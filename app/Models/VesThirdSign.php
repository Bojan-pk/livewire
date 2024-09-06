<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesThirdSign extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order','sign', 'description','note','ves_second_sign_id','regulation_id'
    ];


    public function secondSign() {
        return $this->belongsTo(VesSecondSign::class,'ves_second_sign_id');
    }

    public function regulation() {

        return $this->belongsTo(Regulation::class);

       }
}
