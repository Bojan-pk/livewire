<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $fillable = [
        'fm_id', 'code', 
    ];

    public function educations()
    {
        return $this->belongsToMany(Education::class, 'catalog_education');
    }

    public function conditions()
    {
        return $this->belongsToMany(Condition::class, 'catalog_condition');
    }

    public function fms()
    {
        return $this->belongsToMany(Fm::class, 'catalog_fm');
    }
    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'catalog_experience');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'catalog_job');
    }


    
}
