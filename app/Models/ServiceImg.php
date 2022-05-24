<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImg extends Model
{
    use HasFactory;
    protected $table = 'bukti_service';
    protected $fillable = ['no_service','foto_before','foto_after'];
    protected $primaryKey = 'no_service';
    public $incrementing = false;


    public function service(){
        return $this->belongsTo(Service::class, 'no_service', 'no_service');
    }
}
