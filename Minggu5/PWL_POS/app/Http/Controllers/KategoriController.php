<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori
        ]);

        return redirect('/kategori');
    }

    public function edit($id)
    {
        $find = KategoriModel::findOrFail($id);
        return view('kategori.edit', ['kategori' => $find]);
    }

    public function simpan(Request $request, $id)
    {
        $user = KategoriModel::find($id);
        $user->kategori_kode = $request->kodeKategori;
        $user->kategori_nama = $request->namaKategori;
        $user->save();

        return redirect('/kategori');
    }

    public function delete($id)
    {
        $find = KategoriModel::findOrFail($id);
        $find->delete();

        return redirect('/kategori');
    }
}
