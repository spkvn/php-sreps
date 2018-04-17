<?php

namespace PHPSREPS\Http\Controllers;

use Illuminate\Http\Request;
use PHPSREPS\Product;

class ProductController extends Controller
{
    /**
     * Returns a view containing All Products in the database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // return the view at /views/products/index.blade.php
        return view('products.index',[
            'products' => $products
        ]);
    }

    /**
     * Returns a view used to create a new Product
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Stores the request data in the database as a Product
     *
     * @param Request $request (Form Data)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'supplier' => $request->supplier,
            'comments' => $request->comments
        ]);

        // Redirects the user back to the route /products/index
        return redirect()->route('products.index');
    }

    /**
     * Returns the form used to edit an existing Product
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Updates the product specified as a route parameter, then
     * redirects back to the index page
     *
     * @param Product $product - Route Parameter
     * @param Request $request - Form Data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Request $request)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'supplier' => $request->supplier,
            'comments' => $request->comments
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Deletes the product from the database
     *
     * @param Product $product - Route Parameter
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
