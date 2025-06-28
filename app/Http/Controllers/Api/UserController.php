<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function index(){
        $user = User::query()->latest()->paginate(20);
        return new UserResource(true, "seluruh user", $user) ;
    }

    public function store(Request $request){
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

    public function show($id){
        $user = User::query()->find($id);
        return new UserResource(true, "User", $user);
    }

    public function update(Request $request, $id){
        try {
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
            $user = User::query()->find($id);
            $user->update([
                'name'=>$request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
            return new UserResource(true, "berhasil update data user", $user);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'gagal',
                'message' => 'gagal update data user',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function destroy($id){
        $user = User::query()->find($id);
        $user->delete();
        return new UserResource(true, "berhasil hapus data user", $user);
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
