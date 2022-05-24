<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    use HasFactory;

    protected $table = 'bengkel';
    protected $fillable = ['pool','r2_r4','nama_bengkel','alamat',
    'no_telp','url'];

    public function pool(){
        return $this->hasOne(Pool::class, 'pool', 'pool');
    }
}
