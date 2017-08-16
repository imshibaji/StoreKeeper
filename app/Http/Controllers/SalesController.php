<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Stock;
use App\Report;
use App\Setting;
use App\ReturnIn;
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

        $sales = Sale::orderBy("created_at", "desc")->paginate(5);

        return view('sale.sales', compact('sales'));
    }

    public function returnList()
    {
      if(!Cart::isEmpty())
          Cart::clear();

        $sales = Sale::orderBy("created_at", "desc")->paginate(5);
        $returns = ReturnIn::orderBy("created_at", "desc")->paginate(5);

        return view('sale.returns', compact('returns'));
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
      $set = Setting::find(1);

      return view('sale.create', compact('orders', 'total', 'totalQualtity','set'));
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
        $sale->cgstPercent = $request->cgst_percent;
        $sale->cgstAmt = $request->cgst_amt;
        $sale->sgstPercent = $request->sgst_percent;
        $sale->sgstAmt = $request->sgst_amt;
        $sale->discountPercent = $request->discount_percent;
        $sale->discountAmt = $request->discount_amt;
        $sale->netAmt = $request->net_total;
        $sale->totalAmt = $request->put_total;
        $sale->status = 'Sale';
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

            $datails .= "Name: ".$stock->name.', Qty: '.$dt['quantity'].", Discount: ".$stock->saleDisount.", Unit Price: ".$stock->unitSaleAmt;

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
    public function edit($id)
    {
        $sale = Sale::find($id);

        $orders = Cart::getContent();
        $total = Cart::getTotal();
        $totalQualtity = Cart::getTotalQuantity();

        return view('sale.return', ['sale'=>$sale, 'orders'=> $orders, 'total'=>$total, 'totalQualtity'=> $totalQualtity]);
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
      if($request->units != 0){
        $return = new ReturnIn();
        $return->name = $request->odname;
        $return->details = $request->oddetails;
        $return->unit = $request->units;
        $return->cgstPercent = $request->cgst_percent;
        $return->cgstAmt = $request->cgst_amt;
        $return->sgstPercent = $request->sgst_percent;
        $return->sgstAmt = $request->sgst_amt;
        $return->discountPercent = $request->discount_percent;
        $return->discountAmt = $request->discount_amt;
        $return->netAmt = $request->net_total;
        $return->totalAmt = $request->put_total;
        $return->tmode = $request->tmode;
        $return->sale_id = $sale->id;
        $return->user_id = "1";

        $return->save();



        // Sales Table Update
        $salesDetails = json_decode($sale->details, true);
        $details = json_decode($request->oddetails, true);

        $sdtails = $salesDetails;
          $unitsReturn = 0;
          foreach($details as $dt){
            if($sdtails[$dt['id']]['id'] == $dt['id']){
              $sdtails[$dt['id']]['quantity'] = $sdtails[$dt['id']]['quantity'] - $dt['quantity'];
              $sdtails[$dt['id']]['attributes']['status'] = 'Return';

              $unitsReturn++;
            }
          }
          $sale->unit = (int)$sale->unit - $unitsReturn;
          $sale->details = json_encode($sdtails);
          $sale->cgstPercent = $request->cgst_percent;
          $sale->cgstAmt = (float)$sale->cgstAmt - $request->cgst_amt;
          $sale->sgstPercent = $request->sgst_percent;
          $sale->sgstAmt = (float)$sale->sgstAmt - $request->sgst_amt;
          $sale->discountPercent = $request->discount_percent;
          $sale->discountAmt = $sale->discountAmt - $request->discount_amt;
          $sale->netAmt = $sale->netAmt - $request->net_total;
          $sale->totalAmt = $sale->totalAmt - $request->put_total;
          $sale->status = 'Return';
          $sale->save();

        //dd($sdtails, $salesDetails, $details);


        // Report Gen
        $report = new Report();

        $report->date = ''.date('d-m-Y');

        $details = json_decode($request->oddetails, true);

        $datails = "SID:$sale->id, <<";
        foreach ($details as $dt) {
            $stock = Stock::find($dt['id']);
            $stock->unit = $stock->unit + $dt['quantity'];
            $aunits = $stock->unit;

            $datails .= "Name: ".$stock->name.', Qty: '.$dt['quantity'].", Discount: ".$stock->saleDisount.", Unit Price: ".$stock->unitSaleAmt;

            // if($aunits>0)
            //   $stock->unit = $aunits;
            // else{
            //   $stock->unit = 0;
            // }
            $stock->save();
        }

        $datails .= ">> , Extra Added: ".$request->total_tax.", Extra Discount: ".$request->total_discount.", Trans. Mode:".$request->tmode;

        $report->details = $datails;
        $report->type = "SaleReturn";
        $report->amount = $request->put_total;
        $report->drcr = "dr";
        $report->save();
        return redirect('return/'.$return->id);
      }
      return redirect('sales/'.$sale->id.'/edit');
    }

    public function returnShow($id)
    {
      $set = Setting::find(1);
      $sale = ReturnIn::find($id);
      return view('sale.return-view',['sale'=>$sale, 'set'=>$set]);
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
              'discount' => $prod->saleDisount,
              'status' => 'Sales'
            )
          ]);
        }

      }
      else {
        echo "No Data Found";
      }
      return redirect('sales/create');
    }

    public function orderReturn($sid,$id){
      // echo $sid.' | '.$id;
      $sale = Sale::find($sid);
      $details = json_decode($sale->details, true);

      foreach ($details as $dt) {


          if($dt['id'] == $id){
            $unit = (int) $dt['quantity'];

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
                'id' => $dt['id'],
                'name' => $dt['name'],
                'price' => $dt['price'],
                'quantity' => 1,
                'attributes' => array(
                  'tax' => $dt['attributes']['tax'],
                  'discount' => $dt['attributes']['discount']
                )
              ]);
            }

          }
          else {
            echo "No Data Found";
          }

        }
      return redirect('sales/'.$sid.'/edit');
    }

    public function deleteOrderReturn($sid, $id){
      Cart::remove($id);
      return redirect('sales/'.$sid.'/edit');
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
