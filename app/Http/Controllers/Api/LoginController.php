<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function construct() {
        $this->middleware("auth:api", ["except"=>["login","register"]]);
    }
    public function login(Request $request): \Illuminate\Http\JsonResponse // Tambahkan return type
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email",
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // 422 Unprocessable Entity
        }

        $credentials = $request->only("email", "password");

        // Perbaikan: Lakukan attempt, jika GAGAL, kembalikan error
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email atau password salah', // Pesan lebih informatif
                'status' => 'error'
            ], 401); // 401 Unauthorized
        }

        // Perbaikan: Jika Auth::attempt BERHASIL, lanjutkan untuk mendapatkan user dan token
        $user = Auth::user(); // User sudah diautentikasi
        // Gunakan plainTextToken untuk Sanctum
        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil', // Tambahkan pesan sukses
            'user' => $user,
            'authorisation' => [
                "token" => $token,
                'type' => 'bearer',
            ]
        ], 200); // 200 OK
    }

    public function register(Request $request){
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
                'password' => 'required',
            ],
                [
                    'name.required' => 'Nama tidak boleh kosong',
                    'email.required' => 'Email tidak boleh kosong',
                    'role.required' => 'Role tidak boleh kosong',
                    'password.required' => 'Password tidak boleh kosong',
                ]
            );

            $user = User::query()->create([
                'name'=>$request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            $token =  $user->createToken('AuthToken')->plainTextToken;
            return response()->json([
                'status'=>'succes',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

        }catch (\Exception $e){
            return response()->json([
                'message' => 'gagal menyimpan data',
                'error' => $e->getMessage()
            ], 422);
        }
    }
    public function logout(Request $request)
    {
        // Menghapus token akses saat ini
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil logout',
        ]);
    }
}
