<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RulebooksTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'rb', 'name'
   ];

 public function rulebooks()
    {
        //dd('stiglo');
        return $this->hasMany(Rulebook::class);
    }

}
