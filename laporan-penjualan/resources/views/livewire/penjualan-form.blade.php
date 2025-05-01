<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: #7E1010;">
            <h4 class="text-center m-0">Tambah Penjualan</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="barang_id" class="form-label">Nama Menu</label>
                    <select wire:model.live="barang_id" class="form-control" required>
                        <option value="">Pilih Menu</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah_terjual" class="form-label">Jumlah Terjual</label>
                    <input type="number" wire:model.live="jumlah_terjual" class="form-control"
                        placeholder="Masukkan Jumlah" required>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" wire:model="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Satuan</label>
                    <input type="text" class="form-control" value="{{ number_format($harga ?? 0, 0, ',', '.') }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" class="form-control"
                        value="{{ number_format($total_harga ?? 0, 0, ',', '.') }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select wire:model="metode_pembayaran" class="form-control" required>
                        <option value="">Pilih Metode</option>
                        <option value="Cash">Cash</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Transfer">Transfer</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" wire:click.prevent="save" class="btn btn-primary">
                        {{ $penjualanId ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
