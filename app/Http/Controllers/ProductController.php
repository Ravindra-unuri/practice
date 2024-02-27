<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ResponseTrait;

    public function create(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
        ]);

        if (Product::where('product_name', $request->input('product_name'))->exists()) {
            // return response()->json([
            //     'message' => 'Product already exists',
            //     'status' => 'fail'
            // ], 401);
        return $this->sendConflictResponse(__('Product already exists'));
        }

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');

        $product->save();

    }

    public function get(Request $request)
    {
        $search = $request->input('product_name');

        if (!empty($search)) {
            $data = Product::where('product_name', 'LIKE', '%' . $search . '%')
                ->paginate(3);
        } else {
            $data = Product::paginate(3);
        }

        if ($data->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
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

    public function find($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $this->sendSuccessResponse(__('Success'), $product);
            
        } catch (ModelNotFoundException $exception) {
            Log::error('Product with ID '.$id.' not found in the database.');
            return $exception;
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
