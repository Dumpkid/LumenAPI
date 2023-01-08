<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function show()
    {
        $buku = Buku::all();
        $count = $buku->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Buku',
                'data' => $buku
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Buku Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $buku = Buku::find($id);

        if($buku){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $buku
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
        $kode_buku = "BK".random_int(1,100);
        $judul = $request->input('judul');
        $id_penulis = $request->input('id_penulis');
        $id_penerbit = $request->input('id_penerbit');
        $tahun_terbit = $request->input('tahun_terbit');
        $edisi = $request->input('edisi');
        $halaman = $request->input('halaman');
        $id_jenis = $request->input('id_jenis');
        $isbn = $request->input('isbn');
        $harga = $request->input('harga');
        $sumber = $request->input('sumber');
        $kondisi = $request->input('kondisi');
        // $id_pinjam = $request->input('id_pinjam');

        $cek_isbn = Buku::where('isbn',$isbn)->first();
        if ($cek_isbn){
            return response([
                'Success' => false,
                'message' => 'No ISBN sudah terdaftar'
            ],400);
        }else {
            $buku = Buku::create([
                'kode_buku' => $kode_buku,
                'judul' => $judul,
                'id_penulis' => $id_penulis,
                'id_penerbit' => $id_penerbit,
                'tahun_terbit' => $tahun_terbit,
                'edisi' => $edisi,
                'halaman' => $halaman,
                'id_jenis' => $id_jenis,
                'isbn' => $isbn,
                'harga' => $harga,
                'sumber' => $sumber,
                'kondisi' => $kondisi,
                // 'id_pinjam' => $id_pinjam
            ]);
    
            if ($buku){
                return response([
                    'Success' => true,
                    'message' => 'Buku berhasil ditambahkan!'
                ],201);
            } else {
                return response([
                    'Success' => false,
                    'message' => 'Gagal menambah buku!'
                ],400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $buku = Buku::where('id_buku', $id)->first();
        if (!$buku) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $buku->update($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $buku,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $buku = Buku::find($id);
        if ($buku){
            $hapus = $buku->delete();
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
