<?php

namespace PHPSREPS\Http\Controllers;

use Illuminate\Http\Request;
use PHPSREPS\Product;
use PHPSREPS\Sale;

class SalesController extends Controller
{
    /**
     * Returns a view containing All Sales in the database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all Sales from the database
        $sales = Sale::all();

        // return the view at /views/sales/index.blade.php
        return view('sales.index',[
            'sales' => $sales
        ]);
    }

    /**
     * Returns a view used to create a new Sale
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Stores the request data in the database as a Sale
     *
     * @param Request $request (Form Data)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $sale = Sale::create([
            'customer' => $request->customer,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'product_id' => $request->product,
            'total' => $request->total
        ]);

        // Redirects the user back to the route /sales/index
        return redirect()->route('sales.index');
    }

    /**
     * Returns the form used to edit an existing Sale
     *
     * @param Sale $sale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Sale $sale)
    {
        return view('sales.edit', [
            'sale' => $sale,
            'product' => $sale->product
        ]);
    }

    /**
     * Updates the sale specified as a route parameter, then
     * redirects back to the index page
     *
     * @param Product $sale - Route Parameter
     * @param Request $request - Form Data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Sale $sale, Request $request)
    {
        $sale->update([
            'customer' => $request->customer,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'product_id' => $request->product,
            'total' => $request->total
        ]);

        return redirect()->route('sales.index');
    }

    /**
     * Deletes the sale from the database
     *
     * @param Product $sale - Route Parameter
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index');
    }


    public function autocompleteResults(Request $request)
    {
        // get the name from the request; concat the SQL wildcard characters
        $name = isset($request->name)? '%'.$request->name.'%': "";

        // search products table for the name
        $similarProducts = Product::where('name','like',$name)
            ->get();

        $jsonItem = null;

        foreach($similarProducts as $product){
            $jsonItem[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price
            ];
        }
        return response()->json($jsonItem);
    }
}
