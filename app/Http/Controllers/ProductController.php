<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function index() : View
    {
        return view('products.index', [
        'products' => Product::latest()->paginate(4)
        ]);
    }
    /**
    * Show the form for creating a new resource.
    */

    public function create() : View
    {
        return view('products.create');
    }
    /**
    * Store a newly created resource in storage.
    */

    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('uploadFile')) {
            // Handle file upload
            $file = $request->file('uploadFile');
            $path = Storage::disk('public')->putFile('file-uploads', $file); // Store the file
            $path = Storage::url($path); // Generate the public URL for the stored file
    
            // Merge the file path into the request data
            $request->merge(['imageurl' => $path]);
        }
    
        // Create the product with the updated request data
        Product::create($request->all());
    
        // Pass the URL to the view
        return view('products.upload')->with('url', $path);
    }
    /**
    * Display the specified resource.
    */

    public function show(Product $product) : View
    {
        return view('products.show', compact('product'));
    }
    /**
    * Show the form for editing the specified resource.
    */

    public function edit(Product $product) : View
    {
        return view('products.edit', compact('product'));   
    }
    /**
    * Update the specified resource in storage.
    */

    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('uploadFile')) {
            $file = $request->file('uploadFile');
            $path = $file->store('file-uploads', 'public'); // Save to 'storage/app/public/file-uploads'
            $request->merge(['imageurl' => $path]); // Add the path to the request data
        }
    
        $product->update($request->all());
    
        return redirect()->route('products.index')->withSuccess('Product updated successfully.');
    }
    /**
    * Remove the specified resource from storage.
    */

    public function destroy(Product $product) : RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->withSuccess('Product is deleted successfully.');
    }
}
