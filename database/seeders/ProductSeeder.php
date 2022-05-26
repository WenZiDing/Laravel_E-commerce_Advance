<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			Product::upsert([
				['id'=>12, 'title' => '固定資料1', 'content'=>'固定內容1' , 'price' => rand(1,300) , 'quantity' => 20],
				['id'=>13, 'title' => '固定資料2', 'content'=>'固定內容2' , 'price' => rand(1,300) , 'quantity' => 20]
			],['id'], ['price','quantity']);
        //
    }
}
