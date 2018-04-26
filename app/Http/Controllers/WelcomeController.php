<?php

namespace PHPSREPS\Http\Controllers;

use Illuminate\Http\Request;
use PHPSREPS\Product;

class WelcomeController extends Controller
{
    public function home()
    {
        $lowQuantityProducts = Product::where('quantity', '<', 50)
            ->get();
        
        return view('welcome', [
            'lowStockProducts' => $lowQuantityProducts
        ]);
    }
}
