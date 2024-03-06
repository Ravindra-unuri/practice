<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\product;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ResponseTrait;

    public function create(ProductRequest $request)
    {

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
        return $this->sendSuccessResponse(__('Product created successfully'), $product);
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
        $arr = $data->toJson();

        if ($data->isNotEmpty()) {
            return $this->sendSuccessResponse(__('success'), $arr);
        } else {
            return $this->sendNotFoundResponse(__('Product not found'));
        }
    }

    public function detail($id)
    {
        $data = product::where('products.id', $id)
            ->get();

        if ($data->isNotEmpty()) {
            return response()->json([
                '' => 'success',
                'data' => $data->toArray()
            ], 200);
        } else {
            return $this->sendNotFoundResponse(__('Product not found'));
        }
    }

    public function explicitFind($product)
    {
        return $this->sendSuccessResponse(__('success'), $product);
    }

    public function find($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $this->sendSuccessResponse(__('Success'), $product);
        } catch (ModelNotFoundException $exception) {
            Log::error('Product with ID ' . $id . ' not found in the database.');
            return $exception;
        }
    }

    public function update(ProductRequest $request, $id)
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
                return $this->sendSuccessResponse(__('Product updated successfully'));
            } else {
                return $this->sendFailedResponse(__('Failed to update product or no changes made'));
            }
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->sendNotFoundResponse(__('Product not found'));
        } else {
            $product->delete();
            return $this->sendSuccessResponse(__('Product deleted successfully'));
        }
    }
}
