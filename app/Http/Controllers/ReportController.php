<?php

namespace App\Http\Controllers;

use App\Http\Requests\TotalSalesRequest;
use App\Jobs\NotifyUserOfCompletedReport;
use App\Jobs\SalesReportJob;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Chartisan\PHP\Chartisan;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        return view('reports.reportIndex', compact('now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chart = Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Sample 1', [1, 2, 3]);
//            ->toJSON();


        return view('reports.pieChart', compact('chart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\report  $r
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }


    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\report  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, report $r)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\report  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy(report $r)
    {
        //
    }


    public function totalSalesByCtgry(TotalSalesRequest $request)
    {
        $from = $request->initialDate;
        $to = $request->finalDate;

        dispatch(new SalesReportJob($from, $to, auth()->user()));


        return 'Reporte en cola, se le enviara un email cuando este listo';


    }

    public function salesStatus()
    {
        $approved = Order::where('status', 'approved')->count();
        $rejected = Order::where('status', 'rejected')->count();

    }

    public function piechart()
    {
        return view('reports.pieChart');
    }

    public function viewReport($path)
    {


        return view($path);
    }


}
