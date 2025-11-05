<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        Gate::authorize('admin');

        return view('products.index', [
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin');

        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Product::create([
            ...$data,
            'remark' => $request->remark
        ]);

        return redirect()->route('products.index')->with('success', 'A new product is added!'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Gate::authorize('admin');

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('admin');

        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $product->update([
            ...$data,
            'remark' => $request->remark
        ]);


        return redirect()->route('products.index')->with('success', 'Product update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('admin');

        $product->delete();

        return redirect()->route('products.index')->with('success', 'A product has been deleted successfully');
    }
}
