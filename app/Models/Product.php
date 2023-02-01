<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function image() {
        try {
            return Image::where('product_id', $this->id)->where('main', true)->first()->link;
        }
        catch(Exception $e) {
            return "default.jpg";
        }
    }

    public function images() {
        return Image::where('product_id', $this->id)->get();
    }

    public function category() {
        return category::find($this->category_id);
    }
}
