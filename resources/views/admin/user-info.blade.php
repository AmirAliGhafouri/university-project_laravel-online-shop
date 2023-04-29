<?php

use App\Http\Controllers\adminController;

?>
@extends('admin/master')
@section('content')

<div class="bg-admin">
    <div class="container py-5">
       <div class="bg-second rounded py-5">
            <h2 class="text-center display-5 mb-5">مشخصات کاربر</h2>
            <table class="table text-center table-font">
                <tr>
                    <th>نام کاربری</th>
                    <td>{{$user->name}}</td>
                </tr>

                <tr>
                    <th>ایمیل</th>
                    <td>{{$user->email}}</td>
                </tr>
            </table>
       </div>
       <div class="py-5">
        @if($orders->all())
            <h2 class="display-4 my-5 text-center bg-second rounded">تاریخچه ی سفارش ها</h2>
            @foreach($orders->all() as $item)
                <a href="{{route('order.list',['orderCode'=>$item->orderCode])}}">
                    <ul class="d-flex justify-content-between p-2 my-4 border border border-dark rounded bg-light text-dark shadow">
                        <div class="d-flex">
                            @foreach(adminController::order_group_list($item->orderCode,$user->id)->all() as $product)
                                <li class="m-1"><img src='{{URL::asset("images/products/$product->category/$product->image")}}' class="img-fluid img-responsive rounded order-img"></li>
                            @endforeach
                        </div>
                        <div class="d-flex flex-column">
                            <li class="text-left my-3 ">{{$item->created_at}}</li>
                            <li class="text-left "> کد سفارش : {{$item->orderCode}}</li>
                        </div>
                    </ul>
                </a>
            @endforeach
        @else
                <div class="container text-center my-5">
                    <h2 class="display-4">سفارشی موجود نیست</h2>
                </div>
        @endif
       </div>
    </div>
</div>
@endsection
