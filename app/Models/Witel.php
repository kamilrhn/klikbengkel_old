<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Pool;

class Witel extends Model
{
    use HasFactory;
    protected $table = 'witel_gsd';
    protected $fillable = ['kode_area','witel'];
    protected $primaryKey = 'witel';
    public $incrementing = false;

    public function areanya(){
        return $this->belongsTo(Area::class, 'kode_area','kode_area');
    }
    public function pool(){
        return $this->hasMany(Pool::class, 'witel','witel');
    }

    public function user(){
        return $this->hasOne(Witel::class, 'resp', 'witel');
    }

}
