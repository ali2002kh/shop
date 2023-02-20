<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'number',
        'email',
        'password',
        'fname',
        'lname',
        'balance',
    ];

    protected $hidden = [
        'password',
    ];

    public function hasCart() {
        
        $count = Cart::all()
        ->where('user_id', $this->id)
        ->where('status', 1)
        ->count();

        if ($count > 0) {
            return true;
        }
        return false;
    }

    public function cart() {
        
        return Cart::all()
        ->where('user_id', $this->id)
        ->where('status', 1)
        ->first();
    }

    public function orders() {

        $carts = Cart::all()
        ->where('user_id', $this->id)
        ->where('status', 0);

        $result = [];

        foreach ($carts as $cart) {
            $result[] = $cart->order();
        }

        return $result;
    }

}
