<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderitemResource;
use App\Models\order_items;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index(){
        $order_items = order_items::query()->latest()->paginate(15);
        return new OrderItemResource($order_items, 'Seluruh Data Order Item', true);
    }

    public function store(Request $request){
        try{
            $request->validate([
                'order_id' => 'required',
                'food_id' => 'required',
                'quantity' => 'required',
                'unit_price' => 'required',
                'subtotal' => 'required',
            ],
            [
                'order_id.required' => 'Harus diisi',
                'food_id.required' => 'Harus diisi',
                'quantity.required' => 'Harus diisi',
                'unit_price.required' => 'Harus diisi',
                'subtotal.required' => 'Harus diisi',
            ]
            );
            $order_items = order_items::query()->create([
                'order_id' => $request->order_id,
                'food_id' => $request->food_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'subtotal' => $request->subtotal
            ]);
            return new OrderItemResource($order_items, 'Order Item Successfully Created', true);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'gagal input data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function show($id){
        $order_items = order_items::query()->find($id);
        return new OrderItemResource($order_items);
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'order_id' => 'required',
                'food_id' => 'required',
                'quantity' => 'required',
                'unit_price' => 'required',
                'subtotal' => 'required',
            ],
                [
                    'order_id.required' => 'Harus diisi',
                    'food_id.required' => 'Harus diisi',
                    'quantity.required' => 'Harus diisi',
                    'unit_price.required' => 'Harus diisi',
                    'subtotal.required' => 'Harus diisi',
                ]
            );
            $order_items = order_items::query()->find($id);
            $order_items->update([
                'order_id' => $request->order_id,
                'food_id' => $request->food_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'subtotal' => $request->subtotal
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'gagal input data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
        $order_items = order_items::query()->find($id);
        $order_items->delete();
        return new OrderItemResource($order_items, 'Order Item Deleted', true);
    }
}
