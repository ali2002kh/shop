<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cart_id',
    ];

    public function product() {

        return Product::find($this->product_id);
    }
}
