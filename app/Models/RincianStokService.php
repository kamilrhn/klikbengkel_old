<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianStokService extends Model
{
    use HasFactory;
    protected $table = 'rincian_stokservice';
    protected $fillable = ['kode','nama_barang','spesifikasi', 'harga'];

    public function stokService(){
        return $this->belongsTo(StokService::class, 'kode', 'kode');
    }
}
