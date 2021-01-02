<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductsResource;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        return ProductsResource::collection(Product::all());
    }


    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'description' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'price' => 'required|between:0,999999999.99',
            'type' => 'required|in:hot dish,cold dish,drink,dessert'
        ]);

        if ($request->photo['base64']) {
            $photo = $request->photo;
            $base64str = explode(',', $photo['base64']);
            $imageBin = base64_decode($base64str[1]);
            if (!Storage::disk('public')->exists('fotos/' . $photo['name'])) {
                Storage::disk('public')->put('fotos/' . $photo['name'], $imageBin);
            }
        }
 
        $product = new product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->type = $request->type;
       $product->photo_url = $request->photo['base64'] ? $request->photo['name'] : null;
        $product->save();
        return response()->json(new ProductsResource($product), 201);

    }

    public function updateProduct(Request $request, Product $id)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'description' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'price' => 'required|between:0,999999999.99'
            ]);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->type = $request->type;
        $product = product::findOrFail($id);
        $product->update($request->validated());
        return new ProductsResource($product);
    }


}
