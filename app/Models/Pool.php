<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Witel;
use App\Models\Kendaraan;
use App\Models\User;
use Carbon\Carbon;

class Pool extends Model
{
    use HasFactory;
    protected $table = 'pool_gsd';
    protected $fillable = ['witel','pool'];
    protected $primaryKey = 'pool';
    public $incrementing = false;

    public function kendaraan(){
       return $this->hasMany(Kendaraan::class,'pool','pool');
    }
    public function witelnya(){
        return $this->belongsTo(Witel::class,'witel','witel');
    }
    public function user(){
        return $this->hasOne(User::class,'resp','pool');
    }

    public function bengkel(){
        return $this->hasOne(Bengkel::class, 'pool', 'pool');
    }

    public function distribusi(){
        return $this->hasOne(DistribusiBudget::class, 'pool', 'pool')->whereMonth('bulan', Carbon::now()->month);
    }
}
