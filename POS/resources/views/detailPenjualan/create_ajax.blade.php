<form action="{{ url('/detailPenjualan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <select name="penjualan_id" class="form-control" required>
                        <option value="">- Pilih Kode Penjualan -</option>
                        @foreach($penjualan as $p)
                            <option value="{{ $p->penjualan_id }}">{{ $p->penjualan_kode }}</option>
                        @endforeach
                    </select>
                    <small id="error-penjualan_id" class="error-text text-danger"></small>
                </div>

                <div id="items-container">
                    <!-- Item rows will be added here -->
                    <div class="item-row">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Barang</label>
                                    <select name="items[0][barang_id]" class="form-control barang-select" required>
                                        <option value="">- Pilih Barang -</option>
                                        @foreach($barang as $b)
                                            <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="error-barang_id error-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="items[0][harga]" class="form-control harga-input" required>
                                    <small class="error-harga error-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" name="items[0][jumlah]" class="form-control jumlah-input" required>
                                    <small class="error-jumlah error-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-block remove-item" style="display: none;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="button" id="add-item" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah Barang
                    </button>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        let itemIndex = 1;

        // Add new item row
        $('#add-item').click(function() {
            const newRow = `
                <div class="item-row">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <select name="items[${itemIndex}][barang_id]" class="form-control barang-select" required>
                                    <option value="">- Pilih Barang -</option>
                                    @foreach($barang as $b)
                                        <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">{{ $b->barang_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="error-barang_id error-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" name="items[${itemIndex}][harga]" class="form-control harga-input" required>
                                <small class="error-harga error-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" name="items[${itemIndex}][jumlah]" class="form-control jumlah-input" required>
                                <small class="error-jumlah error-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger btn-block remove-item">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#items-container').append(newRow);
            itemIndex++;
            
            // Show remove button on all rows except first
            $('.remove-item').show();
        });

        // Remove item row
        $(document).on('click', '.remove-item', function() {
            $(this).closest('.item-row').remove();
            calculateGrandTotal();
            
            // Hide remove button if only one row left
            if ($('.item-row').length === 1) {
                $('.remove-item').hide();
            }
        });

        // Auto-fill price when item selected
        $(document).on('change', '.barang-select', function() {
            const selectedOption = $(this).find('option:selected');
            const price = selectedOption.data('harga');
            $(this).closest('.row').find('.harga-input').val(price).trigger('change');
        });

        // Form validation
        $("#form-tambah").validate({
            ignore: [],
            rules: {
                "penjualan_id": { required: true },
                "items[0][barang_id]": { required: true },
                "items[0][harga]": { required: true, digits: true },
                "items[0][jumlah]": { required: true, digits: true }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            tableDetail.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                if (prefix.includes('items.')) {
                                    const parts = prefix.split('.');
                                    const index = parts[1];
                                    const field = parts[2];
                                    $(`[name="items[${index}][${field}]"]`).next(`.error-${field}`).text(val[0]);
                                } else {
                                    $(`#error-${prefix}`).text(val[0]);
                                }
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

<style>
    .item-row {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .subtotal {
        font-weight: bold;
        background-color: #f8f9fa;
    }
    #grand-total {
        color: #28a745;
        font-weight: bold;
    }
</style>