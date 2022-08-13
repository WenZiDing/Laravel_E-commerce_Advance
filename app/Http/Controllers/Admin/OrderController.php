<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index(Request $request){

        $ordersCount = Order::whereHas('orderItems')->count();
        $dataPerPage = 2;
        $orderPage = ceil($ordersCount / $dataPerPage);
        $CurrentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;

        $orders = Order::with(['user','orderItems.product'])->orderBy('created_at', 'desc')
            ->offset($dataPerPage * ($CurrentPage - 1))
            ->limit($dataPerPage)
            ->whereHas('orderItems')
            ->get();
//        dd($orders);

        return view('admin.orders.index',[
            'orders'=>$orders,
            'orderCount'=>$ordersCount,
            'orderPages'=>$orderPage
            ]);
    }
}
