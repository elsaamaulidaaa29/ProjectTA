<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'jumlah_terjual',
        'date',
        'harga',
        'metode_pembayaran',
        'total_harga',
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    protected static function booted()
    {
        static::creating(function ($penjualan) {
            $barang = Barang::find($penjualan->barang_id);
            if ($barang) {
                $penjualan->harga = $barang->harga; // ambil harga dari barang
            }
        });
    }
}
