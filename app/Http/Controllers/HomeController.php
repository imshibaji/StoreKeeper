<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //echo DNS1D::getBarcodeSVG("9239117709", "PHARMA2T").'<br />';
      //echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T").'<br />';
      //echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   /><br />';
      //echo '<img src="' . DNS1D::getBarcodePNGPath("9239117709", "PHARMA2T") . '" alt="barcode"   /><br />';
      //echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T").'<br />';
      //echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("9239117709", "C39+") . '" alt="barcode"   /><br />';



       //echo DNS1D::getBarcodeSVG("9239117709", "C39");
      // echo DNS2D::getBarcodeHTML("9239117709", "QRCODE");
       //echo '<img src="'.DNS2D::getBarcodePNGPath("4445645656", "PDF417").'"  />';
      // echo DNS2D::getBarcodeSVG("4445645656", "DATAMATRIX");
       //echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG("9239117709", "PDF417") . '" alt="barcode"   />';

      //echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("Shibaji Debnath", "C128",1,33) . '" alt="barcode"   />';

      return view('home');
    }
}
