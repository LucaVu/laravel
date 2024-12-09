<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->get();

        return view('admin.modules.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('admin.modules.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $product = new Product();

        $file = $request->image;
        $fileName = time() . '-' . $file->getClientOriginalName();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->featured = $request->featured;
        $product->image = $fileName;
        $product->user_id = 1;

        $product->save();

        $file->move(public_path('images/'), $fileName);
        return redirect()->route('admin.product.index')->with('success', 'Create product successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.modules.product.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
