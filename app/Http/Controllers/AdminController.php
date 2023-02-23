<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function deleteProduct ($product_id) {

        $product = Product::find($product_id);
        $product->delete();

        return abort(200);
    }


}
