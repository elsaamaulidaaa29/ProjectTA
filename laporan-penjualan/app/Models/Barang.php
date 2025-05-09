<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        // 'stock',
        'date',
        'harga',
    ];

    protected $casts = [
        'date' => 'date', // Pastikan 'date' dikonversi ke tipe data Date
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('Y-m-d');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
