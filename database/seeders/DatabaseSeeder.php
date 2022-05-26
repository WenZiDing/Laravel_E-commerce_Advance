<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
			Product::create(['title' => '測試資料', 'content'=>'測試內容' , 'price' => rand(1,300) , 'quantity' => 20]);
	    Product::create(['title' => '測試資料', 'content'=>'測試內容' , 'price' => rand(1,300) , 'quantity' => 20]);
	    Product::create(['title' => '測試資料', 'content'=>'測試內容' , 'price' => rand(1,300) , 'quantity' => 20]);
			$this->call(ProductSeeder::class);
			$this->command->info('產生固定 Product 資料完成');
        // \App\Models\User::factory(10)->create();
    }
}
