@extends('layout.app')
@section('content')

<h2>商品列表</h2>
<img src="https://images.dog.ceo/breeds/mountain-bernese/n02107683_6916.jpg" />
<table>
  <thead>
    <tr>
      <td>標題</td>
      <td>內容</td>
      <td>價格</td>
      <td></td>
    </tr>
  </thead>
  <tbody>

    @foreach ($products as $product)
    <tr>
      <td>{{$product->title}}</td>
      <td>{{$product->content}}</td>
      <td>{{$product->price}}</td>
      <td><input class = "check_product" type = "button" value="確認商品數量" data-id = "{{$product->id}}"></td>
    </tr>
    @endforeach
  </tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).on('click','.check_product',function(){
        // alert($(this).data('id'));
        $.ajax({
            method:'POST',
            url:'/products/check-product',
            data:{
                product_id : $(this).data('id')
            }
        }).done(function (response){
            if (response){
                alert('商品數量充足');
            }else{
                alert('商品數量不構');
            }
        })
    });
</script>
@endsection