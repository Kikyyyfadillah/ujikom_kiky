<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';
    protected $fillable = ['nama_jenis',];

    function menu()
    {
        return $this->hasMany(Menu::class, 'jenis_id', 'id'); //banyak ke banyak
    }
}
