<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class CartController extends Controller
{

    //  here i have created a service container 
    //   $this->app->bind(CartRepository::class, function(){
    //     return new CartModelRepository();
    //    });

    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }


    public function index()
    {
        return view("front.cart", ['cart' => $this->cart]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "product_id" => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1']
        ]);

        $product = Product::findOrFail($request->post('product_id'));


        $this->cart->add($product, $request->post('quantity'));

        return redirect()->route('cart.index')->with('success', 'Product Added To Cart!');
    }


    public function update($id, $quantity)
    {
        $request->validate([
            "product_id" => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1']
        ]);

        $product = Product::findOrFail($request->post('product_id'));

        $this->cart->update($product, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cart->delete($id);
    }
}
