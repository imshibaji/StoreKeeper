<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use App\Report;
use App\Setting;

class StocksController extends Controller
{
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


        return view('stock.stocks',['stocks'=>Stock::all()->sortByDesc("created_at")]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $set = Setting::find(1);
        return view('stock.create', ['profit'=>$set->sales_profit] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->request);
        $stock = new Stock();

        $stock->name = $request->name;
        $stock->description = $request->desc;
        $stock->unit = $request->units;
        $stock->unitPurchPrice = $request->upurprice;
        $stock->totalPurchAmount = $request->tamount;
        $stock->unitSalePrice = $request->usalprice;
        $stock->saleTax = $request->tax;
        $stock->saleDisount = $request->discount;
        $stock->unitSaleAmt = $request->unitsalamt;
        $stock->totalSaleAmount = $request->totsalamt;
        $stock->user_id = '1';

        $stock->save();

        // Report Gen
        $report = new Report();

        $report->date = ''.date('d-m-Y');

        $datails = "PID: $stock->id, Name: $request->name, Description: $request->desc, Units: $request->units, Price per Unit Rs. $request->upurprice";

        $report->details = $datails;
        $report->type = "purchase";
        $report->amount = $request->tamount;
        $report->drcr = "dr";
        $report->save();

        return redirect("stock/$stock->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $setting = Setting::find(1);
        return view('stock.view',['stock'=>$stock, 'set' => $setting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //dd($stock);
        return view('stock.edit', ['stock'=>$stock]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
      $stock->name = $request->name;
      $stock->description = $request->desc;
      $stock->unit = $request->units;
      $stock->unitPurchPrice = $request->upurprice;
      $stock->totalPurchAmount = $request->tamount;
      $stock->unitSalePrice = $request->usalprice;
      $stock->saleTax = $request->tax;
      $stock->saleDisount = $request->discount;
      $stock->unitSaleAmt = $request->unitsalamt;
      $stock->totalSaleAmount = $request->totsalamt;
      $stock->user_id = '1';

      $stock->save();

      return redirect("stock/$stock->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        return redirect('stock');
    }
}
