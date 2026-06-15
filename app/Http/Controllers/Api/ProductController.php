<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // GET
    public function index(Request $request)
    {
        $products = Product::with('category')->latest()->get();

        if (! $request->is('api/*')) {
            return view('products.list', compact('products'));
        }

        return response()->json([
            'success'=>true,
            'data'=>$products
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->latest()->get();

        return view('products.create', compact('categories'));
    }

    // POST
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'is_active'=>'nullable|boolean'
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('products','public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $product = Product::create($data);

        if (! $request->is('api/*')) {
            return redirect()
                ->route('products.index')
                ->with('success', 'Product created successfully.');
        }

        return response()->json([
            'success'=>true,
            'message'=>'Product created',
            'data'=>$product->load('category')
        ],201);
    }

    // GET BY ID
    public function show(Product $product)
    {
        return response()->json([
            'success'=>true,
            'data'=>$product->load('category')
        ]);
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->latest()->get();

        return view('products.edit', compact('product', 'categories'));
    }

    // PUT
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'is_active'=>'nullable|boolean'
        ]);

        unset($data['image']);

        if($request->hasFile('image')){

            if($product->image){
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products','public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $product->update($data);

        if (! $request->is('api/*')) {
            return redirect()
                ->route('products.index')
                ->with('success', 'Product updated successfully.');
        }

        return response()->json([
            'success'=>true,
            'message'=>'Product updated',
            'data'=>$product->load('category')
        ]);
    }

    // DELETE
    public function destroy(Request $request, Product $product)
    {
        if($product->image){
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        if (! $request->is('api/*')) {
            return redirect()
                ->route('products.index')
                ->with('success', 'Product deleted successfully.');
        }

        return response()->json([
            'success'=>true,
            'message'=>'Product deleted'
        ]);
    }
}
