<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        if (product::where('product_name', $request->input('product_name'))->first()) {
            return response([
                'message' => 'Product Already Exist',
                'status' => 'fail'
            ], 401);
        } else {
            product::create([
                'product_name' => $request->input('product_name'),
                'product_price' => $request->input('product_price'),
            ]);

            return response([
                'Status' => 'Success',
                'Message' => 'Product created successfully'
            ], 200);
        }
    }

    public function get(Request $request)
    {
        $search = $request->input('product_name');

        if (!empty($search)) {
            $data = DB::table('products')
                ->where('product_name', 'LIKE', '%' . $search . '%')
                ->paginate(3);
        } else {
            $data = DB::table('products')->paginate(3);
        }

        if ($data->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No products found'
            ], 404);
        }
    }

    public function detail($id)
    {
        $data = DB::table('products')
            ->where('products.id', $id)
            ->first();

        if ($data != null) {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        if (product::where('product_name', $request->input('product_name'))->first()) {
            return response([
                'message' => 'Product Already Exist',
                'status' => 'fail'
            ], 401);
        } else {
            $affectedRows = Product::where('id', $id)->update([
                'product_name' => $request->input('product_name'),
                'product_price' => $request->input('product_price')
            ]);

            if ($affectedRows > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update product or no changes made'
                ], 400);
            }
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'Not found',
                'message' => 'Requested product does not exist'
            ], 404);
        } else {
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ], 200);
        }
    }
}
