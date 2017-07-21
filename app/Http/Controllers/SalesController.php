<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Stock;
use App\Report;
use App\Setting;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Darryldecode\Cart\CartCondition as Condition;

class SalesController extends Controller
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
      if(!Cart::isEmpty())
          Cart::clear();

        $sales = Sale::all()->sortByDesc("created_at");

        return view('sale.sales', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $orders = Cart::getContent();
      $total = Cart::getTotal();
      $totalQualtity = Cart::getTotalQuantity();

      return view('sale.create', compact('orders', 'total', 'totalQualtity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->units != 0){
        $sale = new Sale();
        $sale->name = $request->odname;
        $sale->details = $request->oddetails;
        $sale->unit = $request->units;
        $sale->tax = $request->total_tax;
        $sale->discount = $request->total_discount;
        $sale->netAmt = $request->net_total;
        $sale->totalAmt = $request->put_total;
        $sale->tmode = $request->tmode;
        $sale->user_id = "1";

        $sale->save();


        // Report Gen
        $report = new Report();

        $report->date = ''.date('d-m-Y');

        $details = json_decode($request->oddetails, true);

        $datails = "SID:$sale->id, <<";
        foreach ($details as $dt) {
            $stock = Stock::find($dt['id']);
            $aunits = $stock->unit - $dt['quantity'];

            $datails .= "Name: ".$stock->name.', Qty: '.$dt['quantity'].", Tax: ".$stock->saleTax.", Discount: ".$stock->saleDisount.", Unit Price: ".$stock->unitSaleAmt;

            if($aunits>0)
              $stock->unit = $aunits;
            else{
              $stock->unit = 0;
            }
            $stock->save();
        }

        $datails .= ">> , Extra Added: ".$request->total_tax.", Extra Discount: ".$request->total_discount.", Trans. Mode:".$request->tmode;

        $report->details = $datails;
        $report->type = "sale";
        $report->amount = $request->put_total;
        $report->drcr = "cr";
        $report->save();
        return redirect('sales/'.$sale->id);
      }
      return redirect('sales/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
      $set = Setting::find(1);
      return view('sale.view',['sale'=>$sale, 'set'=>$set]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function getStock($id){
      $prod = Stock::find($id);
      return $prod;
    }

    public function order($id){
      $prod = Stock::find($id);


      if($prod){
        $unit = (int) $prod->unit;

        if(!Cart::isEmpty()){
          $item = Cart::get($id);
          if($item)
            $qty = $item->quantity;
          else
            $qty = 0;
        }else{
          $qty = 0;
        }


        if($unit <= $qty){
          echo $unit .'<='. $qty;
          echo "Product is not Availiable";
        }else{
          Cart::add([
            'id' => $prod->id,
            'name' => $prod->name.' | '.$prod->description,
            'price' => $prod->unitSaleAmt,
            'quantity' => 1,
            'attributes' => array(
              'tax' => $prod->saleTax,
              'discount' => $prod->saleDisount
            )
          ]);
        }

      }
      else {
        echo "No Data Found";
      }
      return redirect('sales/create');
    }

    public function viewOrder(){
        $orders = Cart::getContent();
        return $orders;
    }

    public function updateOrder($id, $qty){
      Cart::update($id, array(
        'quantity' => $qty,
      ));
      return redirect('sales/create');
    }

    public function deleteOrder($id){
      Cart::remove($id);
      return redirect('sales/create');
    }

    public function clearOrder(){
      if(!Cart::isEmpty())
          Cart::clear();
      return redirect('sales/create');
    }
}
