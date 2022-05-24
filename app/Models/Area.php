<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Witel;
use Carbon\Carbon;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area_gsd';
    protected $fillable = ['kode_area','nama_area'];
    protected $primaryKey = 'kode_area';
    public $incrementing = false;
    
    public function witel(){
        return $this->hasMany(Witel::class,'kode_area','kode_area');
    }

    public function setting(){
        return $this->hasOne(Settings::class, 'kode_area', 'kode_area');
    }

    public function user(){
        return $this->hasOne(User::class, 'resp', 'kode_area');
    }

    public function budget(){
        return $this->hasOne(ReleaseBudget::class, 'kode_area', 'kode_area')->whereMonth('bulan', Carbon::now()->month);
    }

    public function distribusi(){
        return $this->hasMany(DistribusiBudget::class, 'kode_area', 'kode_area');
    }
}
