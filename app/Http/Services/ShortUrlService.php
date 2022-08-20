<?php
namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShortUrlService {
    protected $client;
    public function __construct()
    {
        $this->client = new Client();
    }
    public function makeShortUrl($url){
//        $a['123']['123'];
        try {
            $accesstoken = env('SHORT_URL_TOKEN');
            $data = [
                "url"=> $url
            ];
            Log::channel('url_shorten')->info('data',['data'=>$data]);
            $response = $this->client->request(
                'POST',
                "https://api.pics.ee/v1/links/?access_token=$accesstoken",
                [
                    'headers'=> ['Content-Type' => 'application/json'],
                    'body'=> json_encode($data)
                ]
            );
            $contents = $response->getBody()->getContents();
            Log::channel('url_shorten')->info('response',['contents'=>$contents]);
            $contents = json_decode($contents);
//            $contents['a'] = '123';
            return $contents->data->picseeUrl;


        }catch (\Throwable $th){
            report($th);
            return $url;
        }


    }
}
