<?php

namespace App\Http\Controllers;

use App\Setting;
use Auth;
use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
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
        $set = Setting::findOrFail(1);

        return view('setting.settings', compact('set'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $set = new Setting();
        $set->business_name = "Medust Technology Pvt. Ltd.";
        $set->business_address = "83/18B Dum Dum Road. Kolkata-700074";
        $set->business_phone_no = "8981009500";
        $set->gst_no = "None";
        $set->sales_profit = 40;
        $set->discount = 0;
        $set->cgst = 0;
        $set->sgst = 0;

        $set->save();
        return 'Basic Settings is created..<a href="'.url('dashboard').'">Goto To Dashboard</a>';
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('setting.edit', ['set'=>$setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
      $setting->business_name = $request->bname;
      $setting->business_address = $request->baddr;
      $setting->business_phone_no = $request->phone;
      $setting->gst_no = $request->gst_no;
      $setting->sales_profit = $request->profit;
      $setting->discount = $request->discount;
      $setting->cgst = $request->cgst;
      $setting->sgst = $request->sgst;
      $setting->save();

      return redirect('settings');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function setType($id,$type = ''){
      // $user = Auth::user();
      // if($type != ''){
      //   $user->type = $type;
      //   $user->save();
      // }
      $user = User::where('id',$id)->first();
      if($type != ''){
        $user->type = $type;
        $user->save();
      }

      return $user;
    }
}
