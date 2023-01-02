<?php

namespace App\Http\Controllers;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showId($id)
    {
        $anggota = Anggota::find($id);

        if($anggota){
            return response([
                'success' => true,
                'message' => 'User ditemukan!',
                'data' => $anggota
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'User tidak ditemukan!',
                'data' => ''
            ],404);
        }
    }

    public function show()
    {
        $anggota = Anggota::all();
        $count = $anggota->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data anggota',
                'data' => $anggota
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data anggota Kosong',
                'data' => ''
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $anggota = Anggota::where('id_anggota', $id)->first();
        if (!$anggota) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $anggota->fill($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $anggota,
            ],201);
        }
    }

    public function delete($id)
    {
        $anggota = Anggota::find($id)->delete();
        if ($anggota){
            return response([
                'Success' => true,
                'message' => 'Data berhasil dihapus!',
                'data' => ''
            ],200);
        } else {
            return response([
                'Success' => false,
                'message' => 'Data tidak ditemukan! ',
                'data' => ''
            ],404);
        }
    }
}
