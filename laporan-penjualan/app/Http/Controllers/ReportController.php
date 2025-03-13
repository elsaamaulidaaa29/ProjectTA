<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function generatePDF()
    {
        $penjualan = Penjualan::with('barang')->get();

        $data = [
            'penjualan' => $penjualan
        ];

        $pdf = Pdf::loadView('admins.reports.penjualan', $data);
        return $pdf->download('laporan_penjualan.pdf');
    }
}
