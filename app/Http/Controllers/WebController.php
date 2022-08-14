<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class WebController extends Controller
{
    //
    public $notifications = [];
    public function __construct()
    {
        $user = User::find(1);
        $this->notification = $user->notifications ?? [];
    }

    public function index(){
    $product = Product::all();

    return view('web.index',['products'=>$product, 'notifications'=>$this->notification ]);
  }
  public function contactUs(){
    return view('web.contact-us',['notifications'=>$this->notification ]);

  }
  public function readNotification(Request $request){
        $id = $request->all()['id'];
        DatabaseNotification::find($id)->markAsRead();
        return response(['result'=>true]);

  }

}
