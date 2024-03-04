<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function getProduct(){
        $product=Product::paginate(3);  
        // return $product;
        return response([$product]);
    }
}
