<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        $orders = orders::query()->latest()->paginate(15);
        return new OrdersResource($orders, 'Seluruh Data Order', true);
    }
    public function show($id){
        $orders = orders::query()->findOrFail($id);
        return new OrdersResource($orders);
    }

    public function store(Request $request){
        try {
            $request->validate([
                'user_id' => 'required',
                'order_date' => 'required',
                'total_amount' => 'required',
                'status' => 'required',
                'delivery_address' => 'required',
            ],
            [
                'user_id.required' => 'Harus diisi',
                'order_date.required' => 'Harus diisi',
                'total_amount.required' => 'Harus diisi',
                'status.required' => 'Harus diisi',
                'delivery_address.required' => 'Harus diisi',
            ]
            );
            $orders = orders::query()->create([
                'user_id' => $request->user_id,
                'order_date' => $request->order_date,
                'total_amount' => $request->total_amount,
                'status' => $request->status,
                'delivery_address' => $request->delivery_address
            ]);
            return new OrdersResource($orders, 'Order Successfully Created', true);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'gagal menyimpan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'user_id' => 'required',
                'order_date' => 'required',
                'total_amount' => 'required',
                'status' => 'required',
                'delivery_address' => 'required',
            ],
                [
                    'user_id.required' => 'Harus diisi',
                    'order_date.required' => 'Harus diisi',
                    'total_amount.required' => 'Harus diisi',
                    'status.required' => 'Harus diisi',
                    'delivery_address.required' => 'Harus diisi',
                ]
            );
            $orders = orders::query()->findOrFail($id);
            $orders->update([
                'user_id' => $request->user_id,
                'order_date' => $request->order_date,
                'total_amount' => $request->total_amount,
                'status' => $request->status,
                'delivery_address' => $request->delivery_address
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'gagal update data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
        $orders = orders::query()->findOrFail($id);
        $orders->delete();
        return new OrdersResource($orders, 'Order Successfully Deleted', true);
    }
}
