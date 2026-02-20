<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('tags')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $tags = Tag::pluck('name', 'id');
        return view('admin.products.create', compact('tags'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        $product->tags()->sync($request->input('tags', []));

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        $product->load('tags');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $tags = Tag::pluck('name', 'id');
        $product->load('tags');
        return view('admin.products.edit', compact('product', 'tags'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $product->tags()->sync($request->input('tags', []));

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
