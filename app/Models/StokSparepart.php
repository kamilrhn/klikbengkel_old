<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokSparepart extends Model
{
    use HasFactory;
    protected $table = 'stok_sparepart';
    protected $fillable = ['koda','area','nama', 'harga', 'jasa', 'jumlah'];
    protected $primaryKey = 'kode';
    public $incrementing = false;
}
