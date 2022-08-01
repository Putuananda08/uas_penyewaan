<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\mobil;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $mobil = mobil::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $mobil
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $mobil = mobil::where('id', $id)->first();
        if (empty($mobil)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $mobil], 200);
    }
    // menambah data
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'no_plat' => 'required',
            'jenis' => 'required',
            'merk' => 'required',
            'warna' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = mobil::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        $mobil = mobil::where('id', $id)->first();
        if (empty($mobil)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'no_plat' => 'required',
                'jenis' => 'required',
                'merk' => 'required',
                'warna' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $mobil->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $mobil], 200);
        }
    }
    
    // Hapus data berdasar id
    public function destroy($id)
    {
        $mobils = mobil::where('id', $id)->first();
        if (empty($mobils)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $mobils->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $mobils]);
       
    }
        public function indexRelasi()
        {
            $mobil = mobil::with('sewa')->get();
            return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $mobil], 200);
        }

    }
