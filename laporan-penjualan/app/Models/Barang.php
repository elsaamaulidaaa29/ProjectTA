<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'date',
    ];

    protected $casts = [
        'date' => 'date', // Pastikan 'date' dikonversi ke tipe data Date
    ];
}
