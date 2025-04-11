<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
                $btn =  '<button onclick="modalAction(\''.url('/detailPenjualan/' . $detail->detail_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/detailPenjualan/' . $detail->detail_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/detailPenjualan/' . $detail->detail_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $penjualan = PenjualanModel::select('penjualan_id', 'penjualan_kode')->get();

        return view('detailPenjualan.create_ajax')
            ->with('barang', $barang)
            ->with('penjualan', $penjualan);
    }
    public function store_ajax(Request $request)
    {
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'harga'         => 'required|integer',
                'jumlah'        => 'required|integer',
                'barang_id'     => 'required|integer',
                'penjualan_id'  => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            PenjualanDetailModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data detail penjualan berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    public function show_ajax(string $id)
    {
        $detail = PenjualanDetailModel::select('detail_id', 'harga', 'jumlah', 'barang_id', 'penjualan_id')
            ->with('barang')
            ->with('penjualan')
            ->find($id);
            
        return view('detailPenjualan.show_ajax', ['detail' => $detail]);
    }
    public function edit_ajax(string $id)
    {
        $detail = PenjualanDetailModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $penjualan = PenjualanModel::select('penjualan_id', 'penjualan_kode')->get();
        
        return view('detailPenjualan.edit_ajax', ['detail' => $detail, 'barang' => $barang, 'penjualan' => $penjualan]);
    }
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'harga'         => 'required|integer',
                'jumlah'        => 'required|integer',
                'barang_id'     => 'required|integer',
                'penjualan_id'  => 'required|integer'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            $check = PenjualanDetailModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
    public function confirm_ajax(string $id)
    {
        $detail = PenjualanDetailModel::find($id);
        return view('detailPenjualan.confirm_ajax', ['detail' => $detail]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $detail = PenjualanDetailModel::find($id);
            if ($detail) {
                $detail->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
