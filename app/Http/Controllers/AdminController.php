<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderInfoResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller {

    public function deleteProduct ($product_id) {

        $product = Product::find($product_id);
        $product->delete();

        return abort(200);
    }

    public function deleteCategory ($category_id) {

        $category = Category::find($category_id);
        $category->delete();

        return abort(200);
    }

    public function updateCategory (Request $request, $category_id) {

        $request->validate([
            'name' =>  [Rule::unique('categories')->ignore($category_id), 'required'],
        ]);

        $category = Category::find($category_id);
        $category->name = $request->get('name');
        $category->save();

        return abort(200, 'information successfully updated');
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

    public function addProductImage (Request $request, $product_id) {

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('product', 'public');

            $image = new Image([
                "link" => $request->file->hashName(),
                "main" => false,
                "product_id" => $product_id,
            ]);
            
            $image->save();

            return abort(200, 'information successfully updated');
        }

        return abort(421, 'Image is required.');
    }

    public function createCategory (Request $request) {

        $request->validate([
            'name' =>  'required|unique:categories',
        ]);

        $category = new Category([
            "name" => $request->get('name'),
        ]);

        $category->save();

        return abort(200);
    }

    public function orders() {

        $orders = Order::all()->sortByDesc('ordered_at');

        return OrderInfoResource::collection($orders);
    }
}
