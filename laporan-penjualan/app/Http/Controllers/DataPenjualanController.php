<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
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
    public function index()
    {
        $penjualans = Penjualan::with('barang')->get();

        return view('data-penjualan.harian', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
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
        ]);

        Penjualan::create($request->all());

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
        $barangs = Barang::all(); // Ambil semua barang untuk dropdown
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
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'barang_id' => $request->barang_id,
            'jumlah_terjual' => $request->jumlah_terjual,
            'date' => $request->date,
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

        return view('grafikpenjualan');
    }
}
