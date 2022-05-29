<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
			$messages = [
				'required' => ':attribute 是必填的',
				'integer' => ':attribute 必須是數值',
				'between' => ':attribute 的輸入 :input 不在 :min 和 :max 之間'
			];
			$validator = Validator::make($request->all(),[
				'cart_id'=>'required|integer',
				'product_id'=>'required|integer',
				'quantity'=>'required|integer|between:1,10'
			],$messages);
			if ($validator->fails()){
				return response($validator->errors(), 400);
			}
        //
	    $form = $validator->validate();

      $product = Product::find($form['product_id']);
      if(!$product->checkQuantity($form['quantity'])){
        return response($product->title.'數量不足',400);
      }

			$cart = Cart::find($form['cart_id']);
			$result = $cart->cartItems()->create(['product_id' => $product->id,
				'quantity' => $form['quantity'],]);
//			DB::table('cart_items')->insert([
//				'product_id' => $form['product_id'],
//				'quantity' => $form['quantity'],
//			]);
	    return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateValidate $request, $id)
    {
        //
	    $form = $request->validated();
			$item = CartItem::find($id);
			$item->fill(['quantity'=>$form['quantity']]);
			$item->save();
	    DB::table('cart_items')->where('id', $id)
		                              ->update(['quantity' => $form['quantity'],
			                                      'updated_at' => now()]);
	    return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
//	    $form = $request->all();
	    CartItem::find($id)->delete();
//	    DB::table('cart_items')->where('id', $id)
//		    ->delete();
	    return response()->json(true);
    }
}
