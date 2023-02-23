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

    public function storeProduct (Request $request) {

        $product = new Product([
            'name' => $request->get('name'),
            'category_id' => $request->get('category'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'count' => $request->get('count'),
            'details' => $request->get('details'),
        ]);

        $product->save();

        return $product->id;
    }
}
