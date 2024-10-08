<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    
    public function catalogs()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_experience');
    }
}
