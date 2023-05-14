<?php

use App\Http\Controllers\productController;
use App\Models\order;

?>
@extends('master')
@section('content')
    <div class="container">
        <h2 class="display-4 my-5 text-center">سفارش ها</h2>
        <div></div>
        <table class="table text-center">
            <tr>
                <th>تصویر محصول</th>
                <th>نام محصول</th>
                <th>قیمت</th>
            </tr>

            @foreach($orders->all() as $product)
                <tr>
                    <td><a href="{{route('product.details',['id'=>$product->pid])}}"><img src='{{URL::asset("images/products/$product->category/$product->image")}}' class="img-fluid img-responsive rounded order-img"></a></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}تومان</td>
                </tr>
            @endforeach

        </table>

        <h3 class="text-center mb-4">جزئیات سفارش</h3>
        <div class="d-flex justify-content-center">
            <table class="table text-center border col-md-8">
                <tr>
                    <td>کد سفارش</td>
                    <td>{{$info->orderCode}}</td>
                </tr>

                <tr>
                    <td>نوع پرداخت</td>
                    <td>{{$info->payment_method}}</td>
                </tr>

                <tr>
                    <td>تاریخ سفارش</td>
                    <td>{{$info->created_at}}</td>
                </tr>

                <tr>
                    <td>آدرس</td>
                    <td>{{$info->address}}</td>
                </tr>
            </table>
        </div>

{{--        <div class="row mt-5 pt-3 d-flex flex-row-reverse justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class=" p-3 p-md-4">--}}
{{--                    <h3 class="text-center mb-4">جزئیات سفارش</h3>--}}
{{--                    <p class="d-flex justify-content-around my-5">--}}
{{--                        <span>کد سفارش</span>--}}
{{--                        <span>{{$info->orderCode}}</span>--}}
{{--                    </p>--}}

{{--                    <p class="d-flex justify-content-around my-5">--}}
{{--                        <span>نوع پرداخت</span>--}}
{{--                        <span>{{$info->payment_method}}</span>--}}
{{--                    </p>--}}
{{--                    <hr>--}}
{{--                    <p class="d-flex justify-content-around">--}}
{{--                        <span>تاریخ سفارش</span>--}}
{{--                        <span>{{$info->created_at}}</span>--}}
{{--                    </p>--}}
{{--                    <hr>--}}
{{--                    <p class="d-flex justify-content-around">--}}
{{--                        <span>آدرس</span>--}}
{{--                        <span>{{$info->address}}</span>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

@endsection

