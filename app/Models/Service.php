<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;
use App\Models\Invoice;
use App\Models\StokService;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $fillable = ['no_service','nopol', 'reg_urg','km','jenis_bengkel' ,'bengkel','tanggal', 'tanggal_awal', 'tanggal_akhir', 'status', 'subtotal',
                            'total', 'ppn', 'foto_before'];
    protected $primaryKey = 'no_service';
    public $incrementing = false;

    public function invoice(){
        return $this->hasOne(Invoice::class, 'no_service', 'no_service');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'no_service', 'no_service');
    }

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'nopol', 'nopol');
    }

    public function rincian(){
        return $this->hasMany(ServiceDetail::class, 'no_service', 'no_service');
    }

    public function foto(){
        return $this->hasOne(ServiceImg::class, 'no_service', 'no_service');
    }
}
