<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function image() {
        try {
            return Image::where('product_id', $this->id)->where('main', true)->first()->link;
        }
        catch(Exception $e) {
            return "image";
        }

        
    }

    public function images() {
        return Image::where('product_id', $this->id);
    }
}
