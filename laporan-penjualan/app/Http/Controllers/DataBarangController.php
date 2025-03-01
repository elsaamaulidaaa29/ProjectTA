<?php

namespace App\Http\Controllers;

// use App\Models\produk;
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
            'stock' => 'required|integer|min:0',
            'date'  => 'required|date',
        ]);

        Barang::create([
            'name'  => $request->name,
            'stock' => $request->stock,
            'date'  => $request->date,
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
            'stock' => 'required|integer|min:0',
            'date'  => 'required|date',
        ]);

        $barang->update([
            'name'  => $request->name,
            'stock' => $request->stock,
            'date'  => $request->date,
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

        return view('grafikproduk');
    }
}
