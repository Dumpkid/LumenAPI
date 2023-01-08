<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
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
        $alamat_petugas = $request->input('alamat_petugas');
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));

        $register = Petugas::create([
            'nama_petugas' => $nama_petugas,
            'jabatan' => $jabatan,
            'alamat_petugas' => $alamat_petugas,
            'username' => $username,
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
        $username = $request->input('username');
        $password = $request->input('password');

        $petugas = Petugas::where('username', $username)->first();
        if(!$petugas){
            return response([
                'success' => false,
                'message' => 'Login Gagal!',
                'data' => 'username belum terdaftar.'
            ],404);
        } else {
            if (Hash::check($password, $petugas->password)){
                $apiToken = base64_encode(Str::random(15));
    
                $petugas->update([
                    'api_token' => $apiToken
                ]);
    
                return response([
                    'success' => true,
                    'message' => 'Login Berhasil!',
                    'data' => [
                        'user' => $petugas,
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

    public function registrasi_anggota(Request $request)
    {
        $kode_anggota = "AG".random_int(1,100);
        $nama_anggota = $request->input('nama_anggota');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $cek_email = Anggota::where('email', $email)->first();
        if ($cek_email){
            return response([
                'success' => false,
                'message' => 'Registrasi Gagal!',
                'data' => 'Email sudah digunakan.'
            ],400);
        }

        $register = Anggota::create([
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

    public function login_anggota(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $anggota = Anggota::where('email', $email)->first();
        if(!$anggota){
            return response([
                'success' => false,
                'message' => 'Login Gagal!',
                'data' => 'Email belum terdaftar.'
            ],404);
        } else {
            if (Hash::check($password, $anggota->password)){
                $apiToken = base64_encode(Str::random(15));
    
                $anggota->update([
                    'api_token' => $apiToken
                ]);
    
                return response([
                    'success' => true,
                    'message' => 'Login Berhasil!',
                    'data' => [
                        'user' => $anggota,
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