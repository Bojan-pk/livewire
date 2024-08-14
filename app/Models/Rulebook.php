<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rulebook extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
         'rb', 'fc_sso', 'pg_bb','note','regulation_id','rulebooks_table_id'
    ];

    public function rulebooksTables()
    {
        return $this->belongsToMany(RulebooksTable::class, 'rulebooks_tables');
    }
}
