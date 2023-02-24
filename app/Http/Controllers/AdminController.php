<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller {

    public function deleteProduct ($product_id) {

        $product = Product::find($product_id);
        $product->delete();

        return abort(200);
    }

    public function storeProduct (Request $request) {

        $request->validate([
            'name' =>  'required|unique:products',
            'count' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('product', 'public');

            $product = new Product([
                'name' => $request->get('name'),
                'category_id' => $request->get('category'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'count' => $request->get('count'),
                'details' => '',
            ]);

            $product->save();
            
            $image = new Image([
                "link" => $request->file->hashName(),
                "main" => true,
                "product_id" => $product->id,
            ]);
            
            $image->save();

            return $product->id;

        }

        return abort(421, 'Image is required.');
    }

    public function updateProduct (Request $request, $product_id) {

        $product = Product::find($product_id);

        $request->validate([
            'name' =>  [Rule::unique('products')->ignore($product->id), 'required'],
            'count' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('product', 'public');

            $old_image = $product->getImage();
            $old_image->delete();

            $image = new Image([
                "link" => $request->file->hashName(),
                "main" => true,
                "product_id" => $product->id,
            ]);
            
            $image->save();
        }

        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->category_id = $request->get('category');
        $product->price = $request->get('price');
        $product->count = $request->get('count');
        $product->details = '';

        $product->save();

        return abort(200);
    }

    public function storeProductDetails (Request $request, $product_id) {

        $product = Product::find($product_id);
        $product->details = $request->get('details');
        $product->save();
    }
}
