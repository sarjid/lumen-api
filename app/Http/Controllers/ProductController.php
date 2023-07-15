<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::orderBy('id', 'DESC')->get();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'product_name' => 'required|unique:products|max:255',
            'product_code' => 'required',
            'price' => 'required',
        ]);
        try {
            $product = new Product();
            $product->product_code = $request->product_code;
            $product->product_name = $request->product_name;
            $product->price = $request->price;

            if ($product->save()) {
                return response()->json(['status' => 'success', 'message' => 'Product created successfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products|max:255',
            'product_code' => 'required',
            'price' => 'required'
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->product_code = $request->product_code;
            $product->product_name = $request->product_name;
            $product->price = $request->price;

            if ($product->save()) {
                return response()->json(['status' => 'success', 'message' => 'Product updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Product::findOrFail($id);

            if ($post->delete()) {
                return response()->json(['type' => 'success', 'message' => 'Product deleted successfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
