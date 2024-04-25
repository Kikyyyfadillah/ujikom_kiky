<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $guarded = ['id'];
    protected $fillable = ['jenis_id','nama_menu','harga','image','deskripsi'];


    public function jenis()
    {
        return $this->belongsTo(jenis::class, 'jenis_id');
    }
    public function stok()
    {
        return $this->belongsTo(stok::class, 'id', 'menu_id');
    }
}
