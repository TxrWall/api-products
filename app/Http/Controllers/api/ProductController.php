<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index() 
    {
        return $this->product::all();
    }

    public function show($product) 
    {
        return $this->product->find($product);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required|numeric',
        ]);

        $this->product->create($request->all());

        return response()->json([
            'data' => [
                'message' => 'Produto criado com sucesso.'
                ]
            ]);
    }

    public function update($product, Request $request) 
    {
        $product = $this->product->find($product);

        $product->update($request->all());

        return response()->json([
            'data' => [
                'message' => 'Produto atualizado com sucesso.'
            ]
        ]);
    }

    public function destroy($product) 
    {
        $product = $this->product->find($product);

        $product->delete();

        return response()->json([
            'data' => [
                'message' => 'Produto removido.'
            ]
        ]);
    }
}