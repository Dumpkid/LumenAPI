<?php

namespace App\Http\Controllers;
use App\Models\Petugas;

class PetugasController extends Controller
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

    public function show($id)
    {
        $petugas = Petugas::find($id);

        if($petugas){
            return response([
                'success' => true,
                'message' => 'User ditemukan!',
                'data' => $petugas
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'User tidak ditemukan!',
                'data' => ''
            ],404);
        }
    }
}
