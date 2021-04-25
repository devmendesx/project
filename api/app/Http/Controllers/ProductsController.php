<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResources;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();
            return response()->json([
                'message' => 'Produto inserido com sucesso!'
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Falha ao inserir um produto!'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return response($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->name = isset($request->name) ? $request->name : $product->name;
            $product->name = isset($request->name) ?  $request->description : $product->description;
            $product->name = isset($request->name) ? $request->price : $product->price;
            $product->save();
            return response()->json([
                'message' => 'Produto alterado com sucesso!'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Falha ao alterar o produto!'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'message' => 'Produto excluido com sucesso!'
            ], 200);
        }catch(ModelNotFoundException $exception){
            return response()->json([
                'message' => 'Falha ao deletar o produto'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return new ProductResources(Product::search($request));
    }
}
