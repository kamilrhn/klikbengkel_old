<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'setting';
    protected $fillable = ['kode_area','km','waktu'];
    protected $primaryKey = 'kode_area';
    public $incrementing = false;

    public function area(){
        return $this->belongsTo(Area::class, 'kode_area', 'kode_area');
    }
}
