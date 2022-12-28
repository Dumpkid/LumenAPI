<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Petugas;

class AuthController extends Controller
{
    public function registrasi_petugas(Request $request)
    {
        $nama_petugas = $request->input('nama_petugas');
        $jabatan = $request->input('jabatan');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $register = Petugas::create([
            'nama' => $nama_petugas,
            'jabatan' => $jabatan,
            'email' => $email,
            'password' => $password,
        ]);

        if ($register){
            return response()->json([
                'success' => true,
                'message' => 'Register Berhasil!',
                'data' => $register
            ],201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal!',
                'data' => ''
            ],400);
        }
    }

    public function registrasi_anggota(Request $request)
    {
        $kode_anggota = $request->input('kode_anggota');
        $nama_anggota = $request->input('nama_anggota');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $register = Petugas::create([
            'kode_anggota' => $kode_anggota,
            'nama_anggota' => $nama_anggota,
            'jenis_kelamin'=>$jenis_kelamin,
            'email' => $email,
            'password' => $password,
        ]);

        if ($register){
            return response()->json([
                'success' => true,
                'message' => 'Register Berhasil!',
                'data' => $register
            ],201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Register Gagal!',
                'data' => ''
            ],400);
        }
    }

    public function login_petugas(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = Petugas::where('email', $email)->first();
        if(!$user){
            return response([
                'success' => false,
                'message' => 'Login Gagal!',
                'data' => 'Email belum terdaftar.'
            ],404);
        } else {
            if (Hash::check($password, $user->password)){
                $apiToken = base64_encode(Str::random(40));
    
                $user->update([
                    'api_token' => $apiToken
                ]);
    
                return response([
                    'success' => true,
                    'message' => 'Login Berhasil!',
                    'data' => [
                        'user' => $user,
                        'api_token' => $apiToken
                    ]
                ],201);
            } else {
                return response([
                    'success' => false,
                    'message' => 'Login Gagal!',
                    'data' => 'Password yang anda masukkan salah.'
                ],404);
            }
        }
        
    }
}
