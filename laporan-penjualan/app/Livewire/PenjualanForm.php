<?php

namespace App\Livewire;

use App\Models\Barang;
use Livewire\Component;
use App\Models\Penjualan;

class PenjualanForm extends Component
{
    public $penjualanId = null;
    public $barangs;
    public $barang_id;
    public $jumlah_terjual;
    public $harga;
    public $total_harga;
    public $date;
    public $metode_pembayaran;

    public function mount($penjualanId = null)
    {
        $this->barangs = Barang::where('is_active', true)->get();

        $this->penjualanId = $penjualanId;

        if ($penjualanId) {
            $penjualan = Penjualan::findOrFail($penjualanId);
            $this->barang_id = $penjualan->barang_id;
            $this->jumlah_terjual = $penjualan->jumlah_terjual;
            $this->harga = $penjualan->harga;
            $this->total_harga = $penjualan->total_harga;
            $this->date = $penjualan->date;
            $this->metode_pembayaran = $penjualan->metode_pembayaran;
        }
    }

    public function updatedBarangId($value)
    {
        $barang = Barang::find($value);
        $this->harga = $barang?->harga ?? 0;
        $this->hitungTotal();
    }

    public function updatedJumlahTerjual()
    {
        $this->hitungTotal();
    }

    public function hitungTotal()
    {
        $this->total_harga = $this->harga * intval($this->jumlah_terjual);
    }

    public function store()
    {
        $this->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_terjual' => 'required|integer|min:1',
            'date' => 'required|date',
            'metode_pembayaran' => 'required|string',
        ]);

        $barang = Barang::find($this->barang_id);
        $harga_satuan = $barang->harga;
        $total = $harga_satuan * $this->jumlah_terjual;


        Penjualan::create([
            'barang_id' => $this->barang_id,
            'jumlah_terjual' => $this->jumlah_terjual,
            'date' => $this->date,
            'harga' => $harga_satuan,
            'total_harga' => $total,
            'metode_pembayaran' => $this->metode_pembayaran,
        ]);

        session()->flash('success', 'Data penjualan berhasil ditambahkan!');
        return redirect()->route('penjualan.index');
    }

    public function save()
    {
        $this->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_terjual' => 'required|integer|min:1',
            'date' => 'required|date',
            'metode_pembayaran' => 'required|string',
        ]);

        $barang = Barang::findOrFail($this->barang_id);
        $harga_satuan = $barang->harga;
        $total = $harga_satuan * $this->jumlah_terjual;

        $data = [
            'barang_id' => $this->barang_id,
            'jumlah_terjual' => $this->jumlah_terjual,
            'date' => $this->date,
            'harga' => $harga_satuan,
            'total_harga' => $total,
            'metode_pembayaran' => $this->metode_pembayaran,
        ];

        if ($this->penjualanId) {
            Penjualan::findOrFail($this->penjualanId)->update($data);
            session()->flash('success', 'Data penjualan berhasil diperbarui!');
        } else {
            Penjualan::create($data);
            session()->flash('success', 'Data penjualan berhasil ditambahkan!');
        }

        return redirect()->route('penjualan.index');
    }

    public function render()
    {
        return view('livewire.penjualan-form');
    }
}
