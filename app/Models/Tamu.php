<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tamu';
    protected $fillable = [
        'idevent',
        'nama',
        'jenistamu',
        'instansi',
        'alamat',
        'registrasi'
    ];
}

