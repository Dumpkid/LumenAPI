<?php

namespace App\Http\Controllers;
use App\Models\Buku_Kembali;
use App\Models\Buku_Pinjam;
use Illuminate\Http\Request;

class KembaliController extends Controller
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
        $kembali = Buku_Kembali::all();
        $count = $kembali->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Buku Kembali',
                'data' => $kembali
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Buku Kembali Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $kembali = Buku_Kembali::find($id);

        if($kembali){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $kembali
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
        $id_pinjam = $request->input('id_pinjam');
        $id_buku = $request->input('id_buku');
        $tgl_pengembalian = $request->input('tgl_pengembalian');
        $telat_kembali = $request->input('telat_kembali');
        $denda = $telat_kembali*1500;
        $id_petugas = $request->input('id_petugas');

        $cek_pinjam = Buku_Pinjam::where('id_pinjam',$id_pinjam)->where('status_pinjam','Dipinjam')->first();
        if (!$cek_pinjam){
            return response([
                'Success' => false,
                'message' => 'Buku Belum dipinjam!'
            ],400);
        }else {
            $tambah = Buku_Kembali::create([
                'id_anggota' => $id_anggota,
                'id_pinjam' => $id_pinjam,
                'id_buku' => $id_buku,
                'tgl_pengembalian' => $tgl_pengembalian,
                'telat_kembali' => $telat_kembali,
                'denda' => $denda,
                'id_petugas' => $id_petugas,
            ]);
    
            if ($tambah){
                $cek_pinjam->update([
                    'status_pinjam' => 'Tersedia',
                ]);

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
        $kembali = Buku_Kembali::where('id_kembali', $id)->first();
        if (!$kembali) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $kembali->update($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $kembali,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $kembali = Buku_Kembali::find($id);
        if ($kembali){
            $hapus = $kembali->delete();
            if($hapus){
                return response([
                    'Success' => true,
                    'message' => 'Data berhasil dihapus!',
                    'data' => ''
                ],200);
            }
        } else {
            return response([
                'Success' => false,
                'message' => 'Data tidak ditemukan!',
                'data' => ''
            ],404);
        }
    }
}
