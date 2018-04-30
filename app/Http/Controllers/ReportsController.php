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
        // return the view at /views/reports/index.blade.php
        return view('reports.index');
    }

    public function salesByDay()
    {
        // Fetch sum of all sales totals from db, grouped by day
        // TODO: add where conditions later, limiting the date range?
        $sales = Sale::addSelect(\DB::raw("SUM(total) as `total`, DAY(created_at) as `day`"))
            ->groupBy("day")
            ->get();

        return response()->json($sales,200);
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
