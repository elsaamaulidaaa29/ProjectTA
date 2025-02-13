<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_products',
        'id_sales',
        'jumlah_total',
        'harga_satuan',
        'subtotal',

    ];
}
