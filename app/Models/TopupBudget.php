<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopupBudget extends Model
{
    use HasFactory;
    protected $table = 'topup_budget';
    protected $fillable = ['kode', 'kode_area', 'witel', 'pool','budget', 'keterangan'];

    public function distribusi(){
        return $this->belongsTo(DistribusiBudget::class, 'kode', 'kode');
    }
}
