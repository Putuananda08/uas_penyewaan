<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\sewa;
use Illuminate\Support\Facades\Validator;

class SewaController extends Controller
{
    // menampilkan semua data
    public function index()
    {
        $sewa = sewa::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $sewa
        ], 200);
    }
    // menampilkan berdasarkan id
    public function show($id)
    {
        $sewa = sewa::where('id', $id)->first();
        if (empty($sewa)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $sewa], 200);
    }
    // menambah data
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'customer_id' => 'required',
            'mobil_id' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'total_bayar' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = sewa::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update data
    public function update(Request $request, $id)
    {
        $sewa = sewa::where('id', $id)->first();
        if (empty($sewa)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'customer_id' => 'required',
                'mobil_id' => 'required',
                'tgl_pinjam' => 'required',
                'tgl_kembali' => 'required',
                'total_bayar' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $sewa->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $sewa], 200);
        }
    }
    
    // Hapus data berdasar id
    public function destroy($id)
    {
        $sewa = sewa::where('id', $id)->first();
        if (empty($sewa)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $sewa->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $sewa]);
       
    }
        public function indexRelasi()
        {
            $sewa = sewa::with('customer','mobil')->get();
            return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $sewa], 200);
        }

    }
