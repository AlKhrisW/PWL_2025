@empty($penjualan)
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        </div>
    </div>
</div>
@else
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <table class="table table-borderless table-sm">
                <tr><th>Kode</th><td>{{ $penjualan->penjualan_kode }}</td> <th width="20%"></th> <th>Tanggal Penjualan</th><td>{{ $penjualan->penjualan_tanggal }}</td></tr>
                <tr><th>Petugas</th><td>{{ $penjualan->user->nama ?? '-' }}</td> <th></th> <th>Pembeli</th><td>{{ $penjualan->pembeli }}</td></tr>
            </table>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan->detail as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->barang->barang_kode ?? '-' }}</td>
                            <td>{{ $detail->barang->barang_nama ?? '-' }}</td>
                            <td class="text-right">{{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td class="text-right">{{ $detail->jumlah }}</td>
                            <td class="text-right">{{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" class="text-left">Total</th>
                            <th class="text-right">{{ number_format($penjualan->detail->sum(function($item) { return $item->harga * $item->jumlah; }), 0, ',', '.') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
@endempty