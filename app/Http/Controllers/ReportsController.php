<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class ReportsController extends Controller
{
    private $start = "";
    private $end = "";

    public function __construct(){
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start_date = "";
        $end_date = "";

        //$reports = Report::all()->sortByDesc("created_at");

        $reports = Report::orderBy('created_at', 'desc')->paginate(5);



        $totalDebit =  Report::where('drcr', 'dr')->sum('amount');
        $totalCredit = Report::where('drcr', 'cr')->sum('amount');

        view('report.table', compact('reports', 'totalDebit', 'totalCredit', 'start_date', 'end_date'));

        return view('report.reports', compact('reports', 'totalDebit', 'totalCredit', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = new Report();
        $report->date = date('d-m-Y');
        $report->details = "Sid:1234567890, Shari purchase, 1 peace at Rs. 500/-, Tax Apply 12%";
        $report->type = "sale";
        $report->amount = 500;
        $report->drcr = "cr";
        $report->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd($request);

      $sdate=date_create($request->start_date);
      $start_date = date_format($sdate,"d-m-Y");

      $this->start = $start_date;

      $edate=date_create($request->end_date);
      $end_date = date_format($edate,"d-m-Y");

      $this->end = $end_date;

      $reports = Report::all()->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sortByDesc("created_at");


      $totalDebit =  Report::where('drcr', 'dr')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
      $totalCredit = Report::where('drcr', 'cr')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');

      return view('report.reports', compact('reports', 'totalDebit', 'totalCredit', 'start_date', 'end_date'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }


    public function excel($start="",$end=""){
      $this->start = $start;
      $this->end = $end;

      Excel::create('Reports', function($excel) {
          $excel->sheet('report', function($sheet) {

            if($this->start != ""  || $this->end != ""){
              $reports = Report::all()->where('date', '>=', $this->start)->where('date', '<=', $this->end)->sortByDesc("created_at");

              $totalDebit =  Report::where('drcr', 'dr')->where('date', '>=', $this->start)->where('date', '<=', $this->end)->sum('amount');
              $totalCredit = Report::where('drcr', 'cr')->where('date', '>=', $this->start)->where('date', '<=', $this->end)->sum('amount');

            }else{
              $reports = Report::all()->sortByDesc("created_at");

              $totalDebit =  Report::where('drcr', 'dr')->sum('amount');
              $totalCredit = Report::where('drcr', 'cr')->sum('amount');
            }





              $sheet->loadView('report.table', compact('reports', 'totalDebit', 'totalCredit', 'start_date', 'end_date'));
          });
      })->export('xls');

      return redirect('reports');
    }

    function dashboard(){
      if(Auth::user()->type === "user"){
        return redirect('sales');
      }


      $start = date('d-m-Y', strtotime('-0 days'));
      $end = date('d-m-Y');

      $purchase = Report::where('drcr', 'dr')->where('date', '>=', $start)->where('date', '<=', $end)->sum('amount');

      $sales =   $totalCredit = Report::where('drcr', 'cr')->where('date', '>=', $start)->where('date', '<=', $end)->sum('amount');

      return view('dashboard', compact('start', 'end', 'purchase', 'sales'));
    }
}
