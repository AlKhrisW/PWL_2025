<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan']
        ];

        $page = (object) [
            'title' => 'Detail Penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'detailPenjualan';

        $barang = BarangModel::all();

        return view('detailPenjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $details = PenjualanDetailModel::select('detail_id', 'harga', 'jumlah', 'barang_id', 'penjualan_id')
            ->with('barang')
            ->with('penjualan');

        if ($request->barang_id) {
            $details->where('barang_id', $request->barang_id);
        }
            
        return DataTables::of($details)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($detail) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/detailPenjualan/' . $detail->detail_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/detailPenjualan/' . $detail->detail_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/detailPenjualan/' . $detail->detail_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}
