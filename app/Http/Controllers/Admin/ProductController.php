<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ShortUrlService;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productCount = Product::count();
        $dataPerPage = 2;
        $productPage = ceil($productCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $products = Product::orderBy('created_at', 'desc')
            ->offset($dataPerPage * ($currentPage - 1))
            ->limit($dataPerPage)
            ->get();
        return view('admin.products.index',[
            'products'=>$products,
            'productCount'=>$productCount,
            'productPage'=>$productPage
        ]);
    }

    public function uploadImage(Request $request){
//        dd($request);
        $file = $request->file('product_image');
        $productId = $request->input('product_id');
        if (is_null($productId)){
            return redirect()->back()->withErrors(['msg'=>'參數錯誤']);
        }
        $product = Product::find($productId);
        $path = $file->store('public/images');
        $product->image()->create([
            'filename'=>$file->getClientOriginalName(),
            'path'=>$path
        ]);
        return redirect()->back();
    }

    public function import(Request $request){
        $file = $request->file('excel');
        Excel::import(new ProductsImport, $file);

        return redirect()->back();
    }

}
