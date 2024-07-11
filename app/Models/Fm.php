<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fm extends Model
{
    use HasFactory;

    public function catalogs()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_fm');
    }
}
