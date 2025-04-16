@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/detailPenjualan/create_ajax') }}')" class="btn btn-success btn-sm">Tambah Data</button>
            </div>
        </div>

        <div class="card-body">
            <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-sm row text-sm mb-0">
                            <label for="filter-date" class="col-md-1 col-form-label">Filter</label>
                            <div class="col-md-3">
                                <select name="filter_penjualan" class="form-control form-control-sm filter_penjualan">
                                    <option value="">- Semua -</option>
                                    @foreach($penjualan as $item)
                                        <option value="{{ $item->penjualan_id }}">{{ $item->penjualan_kode }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Kode Penjualan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-sm table-striped table-hover" id="table-detailPenjualan" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penjualan</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Jumlah Barang</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        var tableDetail;
        $(document).ready(function () {
            tableDetail = $('#table-detailPenjualan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('detailPenjualan/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function (d) {
                        d.filter_penjualan = $('.filter_penjualan').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex", 
                        className: "text-center", 
                        width: "5%", 
                        orderable: false, 
                        searchable: false 
                    },
                    {
                        data: "penjualan.penjualan_kode", 
                        width: "20%", 
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "barang.barang_nama", 
                        width: "25%", 
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "harga", 
                        className: "", 
                        width: "15%", 
                        orderable: true,
                        searchable: false,
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: "jumlah", 
                        className: "", 
                        width: "10%" 
                    },
                ]
            });

            $('#table-detailPenjualan_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) {
                    tableDetail.search(this.value).draw();
                }
            });

            $('.filter_penjualan').change(function () {
                tableDetail.draw();
            });
        });
    </script>
@endpush
