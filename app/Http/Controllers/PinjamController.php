<?php

namespace App\Http\Controllers;
use App\Models\Buku_Pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show()
    {
        $pinjam = Buku_Pinjam::all();
        $count = $pinjam->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Buku Pinjam',
                'data' => $pinjam
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Buku Pinjam Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $pinjam = Buku_Pinjam::find($id);

        if($pinjam){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $pinjam
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak ditemukan!',
                'data' => ''
            ],404);
        }
    }

    public function create(Request $request)
    {
        $id_anggota = $request->input('id_anggota');
        $id_buku = $request->input('id_buku');
        $tgl_pinjam = $request->input('tgl_pinjam');
        $lama_pinjam = $request->input('lama_pinjam');
        $tgl_kembali = $request->input('tgl_kembali');
        $id_petugas = $request->input('id_petugas');
        $status_pinjam = 'Dipinjam';

        $cek_peminjaman = Buku_Pinjam::where('id_anggota',$id_anggota)->where('status_pinjam', 'Dipinjam')->first();
        if ($cek_peminjaman){
            return response([
                'Success' => false,
                'message' => 'Anggota belum menyelesaikan peminjaman sebelumnya!'
            ],400);
        }else {
            $tambah = Buku_Pinjam::create([
                'id_anggota' => $id_anggota,
                'id_buku' => $id_buku,
                'tgl_pinjam' => $tgl_pinjam,
                'lama_pinjam' => $lama_pinjam,
                'tg_kembali' => $tgl_kembali,
                'id_petugas' => $id_petugas,
            ]);
    
            if ($tambah){
                return response([
                    'Success' => true,
                    'message' => 'Data berhasil ditambahkan!'
                ],201);
            } else {
                return response([
                    'Success' => false,
                    'message' => 'Gagal menambah data!'
                ],400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $pinjam = Buku_Pinjam::where('id_pinjam', $id)->first();
        if (!$pinjam) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $pinjam->fill($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $pinjam,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $pinjam = Buku_Pinjam::find($id)->delete();
        if ($pinjam){
            return response([
                'Success' => true,
                'message' => 'Data berhasil dihapus!',
                'data' => ''
            ],200);
        } else {
            return response([
                'Success' => false,
                'message' => 'Gagal menghapus data!',
                'data' => ''
            ],404);
        }
        
    }
}
