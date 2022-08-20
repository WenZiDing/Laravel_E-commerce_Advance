{{--@php--}}
{{--    use Illuminate\Support\Facades\DB;--}}
{{--@endphp--}}
{{--{{DB::enableQueryLog()}}--}}
@extends('layout.admin_app')
@section('content')

<h2>後台-產品列表</h2>
<span>產品總數：{{$productCount}}</span>
<div>
    <input type="button" class="import" value="匯入Excel">
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>$error</li>
            @endforeach
        </ul>
    </div>
@endif
<table>
    <thead>
    <tr>
        <td>編號</td>
        <td>標題</td>
        <td>內容</td>
        <td>價格</td>
        <td>數量</td>
        <td>圖片</td>
        <td>功能</td>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->title}}</td>
            <td>{{$product->content}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->quantity}}</td>
            <td>
                @if(isset($product->image_url))
                    <a href="{{$product->image_url}}">圖片連結</a>
                @else
                    無圖片
                @endif
            </td>
            <td>
                <input type="button" class="upload_image" data-id = {{$product->id}} value="上傳圖片">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div>
    @for($i = 1; $i <= $productPage; $i++)
        <a href="/admin/Product?page={{$i}}">第{{$i}}頁</a>
    @endfor
</div>
<script>
    $(document).on('click','.upload_image',function(){
        $('#product_id').val($(this).data('id'));
        $('#upload-image').modal();
    })
    $(document).on('click','.import',function () {
        $('#import_excel').modal();
    })
</script>
{{--{{dd(DB::getQueryLog())}}--}}
@endsection
