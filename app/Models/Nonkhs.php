<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonkhs extends Model
{
    use HasFactory;
    protected $table = 'nonkhs';
    protected $fillable = ['area', 'nama','harga'];
}
