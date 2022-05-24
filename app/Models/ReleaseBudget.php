<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseBudget extends Model
{
    use HasFactory;
    protected $table = 'budget';
    protected $fillable = ['kode',  'kode_area', 'bulan','budget_awal', 'sisa_budget'];
    protected $primaryKey = 'kode';
    public $incrementing = false;


    public function area(){
        return $this->belongsTo(Area::class, 'kode_area', 'kode_area');
    }

    public function distribusi(){
        return $this->hasMany(DistribusiBudget::class, 'kode', 'kode_release');
    }
}
