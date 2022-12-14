<?php

namespace Tests\Browser;

use App\Models\User;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Artisan;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        User::factory()->create([
           'email'=>'vincent@123.com.tw',
        ]);
        Artisan::call('db:seed',['--class' => 'ProductSeeder']);
    }

    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--disable-software-rasterizer',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->with('.special-text', function ($text){
                    $text->assertSee('固定資料');
                });
            $browser->click('.check_product')
                ->waitForDialog(5)
                ->assertDialogOpened('商品數量充足')
                ->acceptDialog();
//                    ->assertSee('Laravel');
//            eval(\Psy\sh());
        });
    }
    public function testFillForm(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/contact-us')
                ->value('[name="name"]', 'cool')
                ->select('[name="product"]' , '食物')
                ->press('送出')
                ->assertQueryStringHas('product', '食物');
//            eval(\Psy\sh());
        });
    }
}
