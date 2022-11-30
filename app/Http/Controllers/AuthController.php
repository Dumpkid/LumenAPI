<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $register = User::create([
            'nama' => $nama,
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

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
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
