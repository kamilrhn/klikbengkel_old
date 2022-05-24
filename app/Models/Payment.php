<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = ['kode_bayar','no_service', 'nominal_service','nominal_nota', 'profit','nama_rekening' ,
                            'no_rekening','nama_bank', 'status', 'file', 'proof', 'notes'];
    protected $primaryKey = 'kode_bayar';
    public $incrementing = false;

    public function service(){
        return $this->belongsTo(Service::class, 'no_service', 'no_service');
    }
}
