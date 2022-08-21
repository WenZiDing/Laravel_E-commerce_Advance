<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Passport\Passport;

class CartItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private $fakeUser;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->fakeUser = User::create([
            'name'=>'vincent',
            'email'=>'vincent@vincent.com.tw',
            'password'=>123456789
        ]);
        Passport::actingAs($this->fakeUser);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
//        $cart = $this->fakeUser->carts()->create();
        $cart = Cart::factory()->create([
            'user_id' => $this->fakeUser->id
        ]);
//        $user = User::create([
//            'name'=>'vincent',
//            'email'=>'vincent@vincent.com.tw',
//            'password'=>123456789
//        ]);
//        $cart = Cart::create(['user_id'=>$user->id]);
//        $product = Product::create([
//           'title'=>'test Product',
//           'content'=>'cool',
//           'price'=>10,
//           'quantity'=>10
//        ]);
        $product = Product::factory()->create();
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id'=>$cart->id, 'product_id'=>$product->id,'quantity'=>2]
        );



//        $response->assertStatus(400);
        $response->assertOk();
//        $response = $this->get('/');
        //        $response->assertStatus(200);
        $product = Product::factory()->less()->create();
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id'=>$cart->id, 'product_id'=>$product->id,'quantity'=>10]
        );
//
        $this->assertEquals( $product->title.'數量不足', $response->getContent());

        $product = Product::factory()->create();
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id'=>$cart->id, 'product_id'=>$product->id,'quantity'=>9999]
        );
        $response->assertStatus(400);

    }
    public function testUpdate(){
//        $cart = $this->fakeUser->carts()->create();
//        $cart = Cart::factory()->create([
//            'user_id' => $this->fakeUser->id
//        ]);
//        $product = Product::create([
//            'title'=>'test Product',
//            'content'=>'cool',
//            'price'=>10,
//            'quantity'=>10
//        ]);
//        $product = Product::factory()->make();
//        $cartItem = $cart->cartItems()->create([
//            'product_id'=>$product->id,
//            'quantity' => 10
//        ]);
        $cartItem = CartItem::factory()->create();

        $response = $this->call(
            'PUT',
            'cart-items/'.$cartItem->id,
            ['quantity'=> 1]
        );
        $this->assertEquals('true', $response->getContent());
        $cartItem->refresh();

        $this->assertEquals(1, $cartItem->quantity);


    }
    public function testDestory(){
//        $cart = $this->fakeUser->carts()->create();
        $cart = Cart::factory()->create([
            'user_id' => $this->fakeUser->id
        ]);
//        $product = Product::create([
//            'title'=>'test Product',
//            'content'=>'cool',
//            'price'=>10,
//            'quantity'=>10
//        ]);
        $product = Product::factory()->make();
        $cartItem = $cart->cartItems()->create([
            'product_id'=>$product->id,
            'quantity' => 10
        ]);
        $response = $this->call(
            'DELETE',
            'cart-items/'.$cartItem->id,
            ['quantity'=> 1]
        );
        $response->assertOK();
        $cartItem = CartItem::find($cartItem->id);

        $this->assertNull($cartItem);
    }
}
