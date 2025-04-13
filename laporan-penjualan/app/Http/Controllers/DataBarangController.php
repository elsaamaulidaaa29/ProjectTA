<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create-barang')->only(['create', 'store']);
        $this->middleware('check.permission:view-barang')->only('index');
        $this->middleware('check.permission:edit-barang')->only(['edit', 'update']);
        $this->middleware('check.permission:delete-barang')->only(['destroy']);
    }

    public function index()
    {
        $barangs = Barang::all();
        return view('data-barang.databarang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'date'  => 'required|date',
            'is_active' => 'required|boolean'
        ]);

        Barang::create([
            'name'  => $request->name,
            'stock' => $request->stock,
            'date'  => $request->date,
            'is_active' => $request->has('is_active'),
        ]);

        Alert::success('Success', 'Data Barang Berhasil Ditambahkan');
        return redirect()->route('barang.index');
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
    public function edit(Barang $barang)
    {
        return view('data-barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'date'  => 'required|date',
            'is_active' => 'nullable|boolean',
        ]);

        $barang->update([
            'name'  => $request->name,
            'stock' => $request->stock,
            'date'  => $request->date,
            'is_active' => $request->has('is_active'),
        ]);

        Alert::success('Success', 'Data Barang Berhasil Diubah');

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index');
    }

    public function grafikProduk()
    {

        // Ambil data stok produk dari database
        $produk = Barang::select('name', 'stock')->orderBy('name', 'asc')->get();

        // Ambil nama produk dan jumlah stok
        $labels = $produk->pluck('name'); // Nama produk
        $data = $produk->pluck('stock'); // Stok produk

        return view('grafik-produk', compact('labels', 'data'));
    }
}
