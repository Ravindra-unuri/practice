<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

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
}
