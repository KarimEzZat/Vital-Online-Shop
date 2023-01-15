<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingController extends Controller
{
    //
    public function add_to_cart(Request $request)
    {
        $product = Product::find(request()->pdt_id);
        $cartItem = \Cart::add([
            'id' => request()->pdt_id,
            'name' => $product->name,
            'quantity' => $request->qty,
            'price' => $product->price,
        ]);

       // \Cart::assosiate($cartItem->rowId, 'App\Product');
        return redirect()->route('cart');
    }

    public function cart()
    {
        // \Cart::clear();
        return view('cart');
    }

    public function cart_delete($id) {
        \Cart::remove($id);
        return redirect()->back();
    }
    
    public function incr($id, $quantity)
    {
        $cart = \Cart::update($id, ['quantity' => +1]);

        return redirect()->back();
    }

    public function decr($id, $quantity)
    {

        $cart = \Cart::update($id, ['quantity' => -1]);

        return redirect()->back();
    }

    public function rapid_add($id)
    {
        $product = Product::find($id);
        $cartItem = \Cart::add([
            'id' => $id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        return redirect()->route('cart');
    }


}
