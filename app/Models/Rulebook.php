<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rulebook extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
         'rb','fm','fc_sso', 'pg_bb','note','regulation_id','rulebooks_table_id'
    ];


    public function regulations()
    {
        //dd('stiglo');
        return $this->hasMany(Regulation::class);
    }

    public function rulebooksTable()  {
        return $this->belongsTo(RulebooksTable::class);
       }
}
