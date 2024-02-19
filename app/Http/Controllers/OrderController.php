<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        order::create([
            'order_name' => $request->input('order_name'),
            'customer_id' => $request->input('customer_id'),
            'product_id' => $request->input('product_id')
        ]);
        return response([
            'status' => 'Success',
            'Message' => 'Order placed successfully'
        ], 200);
    }

    public function get(Request $request)
    {
        $search = $request->input('order_name');

        if (!empty($search)) {
            $data = DB::table('orders')
                ->where('orders.order_name', 'LIKE', '%' . $search . '%')
                ->leftJoin('users as u', 'u.id', '=', 'orders.customer_id')
                ->leftJoin('products as p', 'p.id', '=', 'orders.product_id')
                ->select(
                    'orders.id as Order_ID',
                    'orders.order_name as Order_Name',
                    'u.name as Ordered_By',
                    'p.product_name as Product_Name'
                )->paginate(3);
        } else {
            $data = DB::table('orders')
                ->leftJoin('users as u', 'u.id', '=', 'orders.customer_id')
                ->leftJoin('products as p', 'p.id', '=', 'orders.product_id')
                ->select(
                    'orders.id as Order_ID',
                    'orders.order_name as Order_Name',
                    'u.name as Ordered_By',
                    'p.product_name as Product_Name'
                )->paginate(3);
        }

        if ($data->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No orders found'
            ], 404);
        }
    }



    public function detail($id)
    {
        $data = DB::table('orders')
            ->where('orders.id', $id)
            ->leftJoin('users as u', 'u.id', '=', 'orders.customer_id')
            ->leftJoin('products as p', 'p.id', '=', 'orders.product_id')
            ->select(
                'orders.id as Order_ID',
                'orders.order_name as Order_Name',
                'u.name as Ordered_By',
                'p.product_name as Product_Name'
            )->first();

        if ($data != null) {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found'
            ], 404);
        }
    }
}
