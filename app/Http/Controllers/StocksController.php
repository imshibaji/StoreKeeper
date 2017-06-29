<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
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
        return view('stock.create');
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
        return view('stock.view',['stock'=>$stock]);
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
