{{--@php--}}
{{--    use Illuminate\Support\Facades\DB;--}}
{{--@endphp--}}
{{--{{DB::enableQueryLog()}}--}}
@extends('layout.admin_app')
@section('content')
<h2>後台-訂單列表</h2>
<span>訂單總數：{{$orderCount}}</span>
<div>
    <a href="/admin/Orders/excel/export">匯出訂單(Excel)</a> <br>
    <a href="/admin/Orders/excel/export-by-shipped">匯出分類訂單(Excel)</a>
</div>
<table>
    <thead>
    <tr>
        <td>購買時間</td>
        <td>購買者</td>
        <td>商品清單</td>
        <td>訂單總額</td>
        <td>是否運送</td>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{$order->created_at}}</td>
            <td>{{$order->user->name}}</td>
            <td>
                @foreach($order->orderItems as $orderItems)
                    {{$orderItems->product->title}} &nbsp;
                @endforeach
            </td>
            <td>{{isset($order->orderItems) ? $order->orderItems->sum('price') : 0}}</td>
            <td>{{$order->is_shipped}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div>
    @for($i = 1; $i <= $orderPages; $i++)
        <a href="/admin/Orders?page={{$i}}">第{{$i}}頁</a>
    @endfor
</div>
@endsection
{{--{{dd(DB::getQueryLog())}}--}}
