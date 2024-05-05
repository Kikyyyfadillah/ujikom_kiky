<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $guarded = ['id'];


    public function jenis()
    {
        return $this->belongsTo(jenis::class);
    }
    public function stok()
    {
        return $this->belongsTo(stok::class, 'id', 'menu_id');
    }
}
