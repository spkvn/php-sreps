<?php

namespace PHPSREPS\Http\Controllers;

use Illuminate\Http\Request;
use PHPSREPS\Sale;

class ReportsController extends Controller
{
    /**
     * Returns a view containing All Products in the database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all sales from the database
        $sales = Sale::all();

        // return the view at /views/reports/index.blade.php
        return view('reports.index',[
            'sales' => $sales
        ]);
    }

    public function salesPredictions(Sale $sale)
    {
        //TODO: Figure out algorithm for predicting sales
    }

    public function refresh()
    {
        //TODO: Run sales predtions and redisplay the sales predictions
        return redirect()->route('reports.index');
    }


}
