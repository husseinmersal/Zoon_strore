<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::filter($request->query())
        ->with('category:id,name','store:id,name','tags:id,name') 
        ->paginate();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            'name' => 'required|string|max:255',
            'description'=> 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numberic|gt:price'
        ]);

         $product = Product::create($request->all());
         return Response::json($product, 201 , [
            'location' => route('products.show', $product->id),
         ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Product::with('category:id,name','store:id,name','tags:id,name')
        ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);

        $product->update($request->all());


        return Response::json($product);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json([
            'message' => 'Product Deleted Successfully',
        ],
        200);
    }
}
