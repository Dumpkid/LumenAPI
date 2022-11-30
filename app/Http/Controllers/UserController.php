<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $user = User::find($id);

        if($user){
            return response([
                'success' => true,
                'message' => 'User ditemukan!',
                'data' => $user
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
