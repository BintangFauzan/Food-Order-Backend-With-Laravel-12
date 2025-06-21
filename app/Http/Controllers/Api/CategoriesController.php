<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = categories::query()->latest()->paginate(10);
        return new CategoriesResource($categories, true, "Seluruh Kategori");
    }

    public function store(Request $request){
       try{
           $request->validate([
               'name' => 'required',
               'slug' => 'required',
           ],
               [
                   'name.required' => 'Nama Kategori Harus Diisi',
                   'slug.required' => 'Slug Kategori Harus Diisi',
               ]
           );

           $categories = categories::query()->create([
               'name' => $request->name,
               'slug' => $request->slug
           ]);
           $categories->save();
           return new CategoriesResource($categories, true, "Kategori Baru");
       }catch (\Exception $exception){
           return response()->json([
               'status' => 'error',
               'message'=> 'Gagal Menambah Kategori',
               'error' => $exception->getMessage()
           ]);
       }
    }

    public function show($id)
    {
        $categories = categories::query()->findOrFail($id);
        return new  CategoriesResource($categories, true, "Kategori");
    }

    public function update(Request $request, $id){
       try{
           $request->validate([
               'name' => 'required',
               'slug' => 'required',
           ],
           [
               'name.required' => 'Nama Kategori Harus Diisi',
               'slug.required' => 'Slug Kategori Harus Diisi',
           ]
           );
           $categories = categories::query()->findOrFail($id);
           $categories->update([
               'name' => $request->name,
               'slug' => $request->slug
           ]);
           $categories->save();
           return new CategoriesResource($categories, true, "Berhasil Di Edit");
       }catch (\Exception $exception){
           return response()->json([
               'status' => 'error',
               'message'=> 'Gagal Mengubah Kategori',
               'error' => $exception->getMessage()
           ]);
       }
    }

    public function destroy($id){
        try{
            $categories = categories::query()->findOrFail($id);
            $categories->delete();
            return new CategoriesResource($categories, true, "Berhasil Dihapus");
        }catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'message'=> 'Gagal Menghapus Kategori',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
