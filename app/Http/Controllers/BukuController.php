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
    public function __construct()
    {
        // $this->middleware('auth');
    }

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
        $kode_buku = substr(uniqid("BK"),0,7);
        $judul = $request->input('judul');
        $penulis = $request->input('penulis');
        $penerbit = $request->input('penerbit');
        $tahun_terbit = $request->input('tahun_terbit');
        $edisi = $request->input('edisi');
        $halaman = $request->input('halaman');
        $id_jenis = $request->input('id_jenis');
        $isbn = $request->input('isbn');
        $harga = $request->input('harga');
        $sumber = $request->input('sumber');
        $kondisi = $request->input('kondisi');

        $cek = Buku::where('isbn',$isbn)->first();
        if ($cek){
            return response([
                'Success' => false,
                'message' => 'No ISBN sudah terdaftar!'
            ],400);
        } else {
            $buku = Buku::create([
                'kode_buku' => $kode_buku,
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun_terbit,
                'edisi' => $edisi,
                'halaman' => $halaman,
                'id_jenis' => $id_jenis,
                'isbn' => $isbn,
                'harga' => $harga,
                'sumber' => $sumber,
                'kondisi' => $kondisi
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
        $buku = Buku::where('id', $id)->first();
        if (!$buku) {
            return response([
            'success' => false,
            'message' => 'ID tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $buku->fill($input);
            return response([
                'success' => true,
                'message' => 'data input',
                'data' => $buku,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $buku = Buku::find($id)->delete();
        Buku::truncate();
        if ($buku){
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
