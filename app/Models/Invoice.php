<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $fillable = ['no_invoice','no_service','area', 'witel', 'pool','subtotal','ppn','total'];
    protected $primaryKey = 'no_invoice';
    public $incrementing = false;

    public function service(){
        return $this->belongsTo(Service::class, 'no_service', 'no_service');
    }
}
