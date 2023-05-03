<?php

use App\Http\Controllers\adminController;

?>
@extends('admin/master')
@section('content')
    <div class="bg-admin py-5">
        <div class="container">
            <h2 class="text-center bg-white py-3 rounded shadow">سفارش ها</h2>
           <

           @foreach($orders->all() as $item)
                <a href="{{route('order.list',['orderCode'=>$item->orderCode])}}">
                    <ul class="d-flex justify-content-between p-2 my-4 border border border-dark rounded bg-light text-dark shadow">
                        <div class="d-flex">
                            @foreach(adminController::admin_order_group_list($item->orderCode)->all() as $product)
                                <li class="m-1"><img src='{{URL::asset("images/products/$product->category/$product->image")}}' class="img-fluid img-responsive rounded order-img"></li>
                            @endforeach
                        </div>
                        <div class="d-flex flex-column">
                            <li class="text-left my-3 ">{{$item->username}}</li>
                            <li class="text-left my-3 ">{{$item->created_at}}</li>
                            <li class="text-left "> کد سفارش : {{$item->orderCode}}</li>
                        </div>
                    </ul>
                </a>
            @endforeach
        </div>
    </div>

@endsection