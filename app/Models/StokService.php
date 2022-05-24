<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceDetail;

class StokService extends Model
{
    use HasFactory;
    protected $table = 'stok_service';
    protected $fillable = ['kode','area','jenis', 'merk', 'type','nama_service', 'harga'];
    protected $primaryKey = 'kode';
    public $incrementing = false;

    public function rincianStok(){
        return $this->hasMany(RincianStokService::class, 'kode', 'kode');
    }
}
