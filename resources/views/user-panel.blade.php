<?php

use App\Http\Controllers\productController;
use App\Models\order;

?>
@extends('master')
@section('content')
@if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('success_message')}}
    </div>
@endif

@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('error_message')}}
    </div>
@endif

<div class="d-flex justify-content-between flex-wrap">
   <div class="col-md-3 border-left bg-second">
    <!-- user Info -->
        <div class=" my-5">
            <h2 class="text-center display-5 mb-5">مشخصات کاربر</h2>
            <table class="table text-center table-font">
                <tr>
                    <th>نام کاربری</th>
                    <td>{{$info->name}}</td>
                </tr>

                <tr>
                    <th>ایمیل</th>
                    <td>{{$info->email}}</td>
                </tr>
            </table>
        </div>

    <!-- Change user Info -->
        <div class=" my-5 brder">
            <h2 class="text-center display-5 my-5">ویرایش مشخصات</h2>
            <div>
                <form action="{{route('edit.userInfo')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control @error('username') {{'is-invalid'}} @enderror" id="name" name="username" placeholder="نام جدید . . .">
                        @error('username')
                            <div id="validationServer03Feedback" class="invalid-feedback text-right">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email" placeholder="ایمیل جدید . . .">
                        @error('email')
                            <div id="validationServer03Feedback" class="invalid-feedback text-right">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-eshop">ثبت‌تغییرات</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class=" my-5 brder">
            <h2 class="text-center display-5 my-5">تغییر رمز عبور</h2>
            <form action="{{route('edit.password')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="password" class="form-control @error('oldpswd') {{'is-invalid'}} @enderror" name="oldpswd" placeholder="رمز قدیمی . . .">
                    @error('oldpswd')
                        <div id="validationServer03Feedback" class="invalid-feedback text-right">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control @error('pswd') {{'is-invalid'}} @enderror" name="newpswd" placeholder="رمز جدید . . .">
                    @error('newpswd')
                        <div id="validationServer03Feedback" class="invalid-feedback text-right">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control @error('reNewpswd') {{'is-invalid'}} @enderror" name="reNewpswd" placeholder="تکرار رمز جدید . . .">
                    @error('reNewpswd')
                        <div id="validationServer03Feedback" class="invalid-feedback text-right">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-eshop">تغییر رمز عبور</button>
                </div>
            </form>
        </div>

   </div>
   <!-- order-history -->
    <div class="col-md-9 form-back-ground">
        <div class="text-center my-3 rounded-circle">
            <img class="img-fluid img-responsive rounded-circle order-h-img"  src='{{URL::asset("images/backgrounds/orders.png")}}'>
        </div>
        @if($orders->all())
        <h2 class="display-4 my-5 text-center bg-second rounded">تاریخچه ی سفارش ها</h2>
        @foreach($orders->all() as $item)
            <a href="{{route('order.list',['orderCode'=>$item->orderCode])}}">
                <ul class="d-flex justify-content-between p-2 my-4 border border border-dark rounded bg-light text-dark shadow">
                    <div class="d-flex">
                        @foreach(productController::order_group_list($item->orderCode)->all() as $product)
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



@endsection
