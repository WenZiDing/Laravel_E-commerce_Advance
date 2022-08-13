<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WebController extends Controller
{
    //
  public function index(){
    $product = Product::all();
    return view('web.index',['products'=>$product]);
  }
  public function contactUs(){
    return view('web.contact-us');

  }

}
