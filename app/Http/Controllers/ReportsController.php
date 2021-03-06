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

    public function salesByDay(Request $request)
    {
        // Fetch sum of all sales totals from db, grouped by day
        $sales = Sale::addSelect(\DB::raw("SUM(total) as `total`, DATE(created_at) as `day`"))
            ->whereDate('created_at', '>=', $request->start ?? "1979-01-01") //Input OR 1979
            ->whereDate('created_at', '<=', $request->stop ?? "2032-01-01")  //Input OR 2032
            ->groupBy("day")
            ->get();

        return response()->json($sales,200);
    }

    public function generateSalesCSV()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $sales = Sale::all();

        $columns = array('SalesID', 'Customer', 'Code', 'Quantity', 'Total', 'Date');
        $callback = function() use ($sales, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach($sales as $sale) {
                fputcsv($file, array($sale->id, 
                                    $sale->customer,
                                    $sale->code, 
                                    $sale->lineItems[0]->quantity, 
                                    $sale->total, 
                                    $sale->created_at));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function allSalesForDate(Request $request)
    {
        $sales = Sale::addSelect(\DB::raw("INT(id) as `id`, VARCHAR(customer) as `customer`, INT(total) as `total`, DATE(created_at) as `day`"))
            ->whereDate('created_at', '>=', $request->start ?? "1979-01-01") //Input OR 1979
            ->whereDate('created_at', '<=', $request->stop ?? "2032-01-01")  //Input OR 2032
            ->orderBy("id")
            ->get();
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
