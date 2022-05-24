<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pool;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan_lokal';
    protected $fillable = ['nopol','status_nopol','area','aktivasi',
    'dispatcher','witel','pool','jenis',
    'kbm_sp','kepemilikan','jenis','merk', 'type', 'tahun',
    'status', 'ketersediaan', 'bbm','km', 'last_service','ms_nms', 'kepemilikan', 'r2_r4',
    'lokasi_kbm','warna','no_rangka','no_mesin', 'customers',
    'branding','nama_bengkel'];
    
    protected $primaryKey = 'nopol';
    public $incrementing = false;

    public function pool(){
        return $this->belongsTo(Pool::class, 'pool', 'pool');
    }

    public function service(){
        return $this->hasMany(Service::class, 'nopol', 'nopol')->whereNotNull('status');
    }
    

}
