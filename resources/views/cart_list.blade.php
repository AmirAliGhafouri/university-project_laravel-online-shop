@extends('master')
@section('content')


<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <img src='{{URL::asset("images/backgrounds/cartList.png")}}' class="img-fluid img-responsive cart-img">
    </div>
@if($products->all())
    @foreach($products as $product)
    <div class="d-flex justify-content-center row my-2">
        <div class="col-md-10">
            <div class="row p-2 border rounded">
                <div class="col-md-4 mt-1">
                    <a href="/details/{{$product->id}}">
                        <img class="img-fluid img-responsive rounded "  src='{{URL::asset("images/products/$product->category/$product->image")}}'>
                    </a>
                </div>
                <div class="col-md-5 mt-1 d-flex align-items-center justify-content-center">
                    <h2>{{$product->name}}</h2>
                </div>
                <div class="col-md-3 mt-1 d-flex justify-content-center align-items-center flex-column">
                    <div>
                        <h4 class="mr-1">{{$product->price}}تومان</h4>
                    </div>
                    <div class=" mt-4 ">                      
                        <a class="btn btn-alert" href="{{route('cart.remove',['id'=>$product->cart_id])}}">حذف‌از‌سبد‌خرید <i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center my-5">
        <a href="{{route('order.view')}}" class="btn btn-eshop pb-1 px-5">سفارش</a>
    </div>
@else
    <div class="d-flex justify-content-center">
        <p class="alert-txt mb-5 text-center">سبد خرید شما خالی است !</p>
    </div>
@endif
</div>

@endsection