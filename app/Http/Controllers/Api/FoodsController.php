<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodsResource;
use App\Models\foods;
use http\Env\Response;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FoodsController extends Controller
{
    public function index(){
        $food = foods::query()->latest()->paginate(16);
        return new FoodsResource($food, 'Seluruh data makanan', true);
    }
    public function show($id){
        $food = foods::query()->find($id);
        return new FoodsResource($food, 'data makanan', true);
    }

    public function store(Request $request){
       try{
           $request->validate([
               'category_id' => 'required',
               'name' => 'required',
               'description' => 'required',
               'price' => 'required',
               'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               'is_available' => 'required|boolean',
           ],
               [
                   'category_id.required' => 'Harus diisi',
                   'name.required' => 'Nama makanan harus diisi',
                   'description.required' => 'Deskripsi harus diisi',
                   'price.required' => 'Harga harus diisi',
                   'image_url.required' => 'Foto harus diisi',
                   'image_url.image' => 'Foto harus berupa gambar',
               ]
           );

           $imageFile =  $request->file('image_url');
           // Simpan file ke disk 'public' secara eksplisit
           $imagePath = Storage::disk('public')->putFile('food-images', $imageFile);

           $foods = foods::query()->create([
               'category_id' => $request->category_id,
               'name' => $request->name,
               'description' => $request->description,
               'price' => $request->price,
               // Simpan path yang bisa diakses publik
               'image_url' => '/storage/food-images/' . basename($imagePath),
               'is_available' => $request->is_available
           ]);
           $foods->save();
           return new FoodsResource($foods, 'data makanan berhasil ditambahkan', true);
       }catch (\Exception $e){
           return response()->json([
               'message' => 'data makanan gagal ditambahkan',
               'error' => $e->getMessage(),
               'status' => 'error'
           ]);
       }
    }

    public function update(Request $request, $id){
        try{
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'is_available' => 'required|boolean',
            ],
            [
                'category_id.required' => 'Harus diisi',
                'name.required' => 'Nama makanan harus diisi',
                'description.required' => 'Deskripsi harus diisi',
                'price.required' => 'Harga harus diisi',
                'image_url.required' => 'Foto harus diisi',
                'is_available.required' => 'Status harus diisi',
            ]
            );

             $imageFile =  $request->file('image_url');
           // Simpan file ke disk 'public' secara eksplisit BBBBBBBBBBBBBBBBBBBBBBBB
           $imagePath = Storage::disk('public')->putFile('food-images', $imageFile);

            $foods = foods::query()->find($id);
            $foods->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image_url' => Storage::url($imagePath),
                'is_available' => $request->is_available
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'data makanan gagal diubah',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id){
       try{
           $foods = foods::query()->findOrFail($id);
           $foods->delete();
           return new FoodsResource($foods, 'data makanan berhasil dihapus', true);
       }catch (\Exception $e){
           return response()->json([
               'status' => 'error',
               'message' => 'data makanan gagal dihapus',
               'error' => $e->getMessage(),
           ]);
       }
    }
}
