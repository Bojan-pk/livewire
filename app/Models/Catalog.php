<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    public function educations()
    {
        return $this->belongsToMany(Education::class, 'catalog_education');
    }

    public function conditions()
    {
        return $this->belongsToMany(Education::class, 'catalog_condition');
    }

    public function fms()
    {
        return $this->belongsToMany(Education::class, 'catalog_fm');
    }
    public function experiences()
    {
        return $this->belongsToMany(Education::class, 'catalog_experience');
    }


    
}
