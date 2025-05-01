<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Console\View\Components\Alert;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class DataPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create-sale')->only(['create', 'store']);
        $this->middleware('check.permission:view-sale')->only('index');
        $this->middleware('check.permission:edit-sale')->only(['edit', 'update']);
        $this->middleware('check.permission:delete-sale')->only(['destroy']);
    }
    public function index(Request $request)
    {
        $query = Penjualan::with(['barang' => function ($query) {
            $query->where('is_active', true);
        }]);
        // Cek jika ada filter tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('date', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $penjualans = $query->orderBy('date', 'desc')->get();

        return view('data-penjualan.harian', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::where('is_active', true)->get();
        return view('data-penjualan.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jumlah_terjual' => 'required|integer',
            'date' => 'required|date',
            'metode_pembayaran' => 'required|string',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        Penjualan::create([
            'barang_id' => $request->barang_id,
            'jumlah_terjual' => $request->jumlah_terjual,
            'date' => $request->date,
            'harga' => $barang->harga, // ambil dari barang
            'metode_pembayaran' => $request->metode_pembayaran
        ]);
        FacadesAlert::success('Success', 'Data penjualan berhasil ditambahkan!');

        return redirect()->route('penjualan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $barangs = Barang::where('is_active', true)->get(); // Ambil semua barang untuk dropdown
        return view('data-penjualan.edit', compact('penjualan', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_terjual' => 'required|integer|min:1',
            'date' => 'required|date',
            'harga' => 'required|integer',
            'metode_pembayaran' => 'required|string',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'barang_id' => $request->barang_id,
            'jumlah_terjual' => $request->jumlah_terjual,
            'date' => $request->date,
            'harga' => $request->harga,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        FacadesAlert::success('Success', 'Data penjualan berhasil diperbarui!');

        return redirect()->route('penjualan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index');
    }

    public function grafikPenjualan()
    {

        // Ambil data penjualan dari database, dikelompokkan berdasarkan bulan
        $penjualan = Penjualan::selectRaw('DATE_FORMAT(date, "%Y-%m") as bulan, SUM(jumlah_terjual) as total')
            ->where('date', '>=', Carbon::now()->subMonths(11)->startOfMonth()) // Ambil 12 bulan terakhir
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        // Buat array label bulan berdasarkan data yang ada di database
        $labels = $penjualan->pluck('bulan')->map(function ($bulan) {
            return Carbon::parse($bulan)->translatedFormat('F Y'); // Format bulan dalam bahasa Indonesia
        });

        // Ambil total jumlah penjualan berdasarkan bulan
        $data = $penjualan->pluck('total');

        // Tambahkan nilai minimum dan maksimum untuk skala
        $minValue = $data->min() > 0 ? 0 : $data->min();
        $maxValue = $data->max() * 1.1; // Tambahkan 10% untuk ruang di atas

        return view('grafikpenjualan', compact('labels', 'data', 'minValue', 'maxValue'));
    }

    public function grafikPenjualanKeseluruhan()
    {
        // Ambil data penjualan berdasarkan nama produk
        $penjualan = Penjualan::selectRaw('barang_id, SUM(jumlah_terjual) as total')
            ->groupBy('barang_id')
            ->with('barang')
            ->get();

        // Format data untuk Chart.js
        $labels = $penjualan->pluck('barang.name');
        $data = $penjualan->pluck('total');


        return view('grafik-produk-all', compact('labels', 'data'));
    }
}
