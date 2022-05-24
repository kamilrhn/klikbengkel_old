<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\StokService;

class ServiceDetail extends Model
{
    use HasFactory;
    protected $table = 'rincian_service';
    protected $fillable = ['no_service', 'kategori','jenis_service','keterangan','qty', 'subtotal', 'harga'];

    public function service(){
        return $this->belongsTo(Service::class, 'no_service', 'no_service');
    }

}
