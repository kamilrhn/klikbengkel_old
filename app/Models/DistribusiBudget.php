<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiBudget extends Model
{
    use HasFactory;
    protected $table = 'distribusi_budget';
    protected $fillable = ['kode', 'kode_area', 'witel', 'pool', 'bulan','budget_awal', 'sisa_budget'];
    protected $primaryKey = 'kode';
    public $incrementing = false;

    public function area(){
        return $this->belongsTo(Area::class, 'kode_area', 'kode_area');
    }

    public function pool(){
        return $this->belongsTo(Pool::class, 'pool', 'pool');
    }

    public function topup(){
        return $this->hasMany(TopupBudget::class, 'kode', 'kode');
    }

    public function release(){
        return $this->belongsTo(ReleaseBudget::class, 'kode_release', 'kode');
    }
}
