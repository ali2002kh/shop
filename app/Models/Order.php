<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'city_id',
        'zip_code',
        'address',
        'shipping_cost',
        'final_price',
        'status',
        'code',
        'telephone',
        'ordered_at',
        'sent_at',
        'received_at'
    ];

    public $timestamps = false;

    public function cart() {

        return Cart::find($this->cart_id);
    }

    public function user() {
        return $this->cart()->user();
    }

    public function status() {

        if ($this->status == 0) {
            return "pending";
        } else if ($this->status == 1) {
            return "sent";
        } else {
            return "received";
        }
    }

    public function city() {
        
        return DB::table('cities')
            ->where('id', $this->city_id)
            ->first();
    }

    public function province() {
        return DB::table('provinces')
                ->where('id', $this->city()->province)
                ->first();
    }


}
