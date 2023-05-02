@extends('admin/master')
@section('content')
    <div class="bg-admin py-5">
        <div class="container">
            <h2 class="text-center bg-white py-3 rounded shadow">سفارش ها</h2>
            @foreach($orders as $order)
                <div class="d-flex justify-content-center my-3 row">
                    <div class="col-md-8 shadow">
                        <div class="row p-2 bg-light rounded d-flex justify-content-between">
                            <div class="col-md-3 mt-1 d-flex justify-content-center">
                                <div class="d-flex justify-content-center align-items-center rounded-circle bg-third text-white username-prf">
                                    <i>{{$order->username}}</i>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-1 text-center"><img src='{{URL::asset("images/products/$order->category/$order->image")}}' class="img-fluid img-responsive rounded order-img"></div>
                            </div>
                                    
                            <div class="col-md-2 mt-1 d-flex justify-content-center align-items-center flex-column">
                                <div>
                                    <a class="btn btn-eshop" href="#">اطلاعات </a>
                                </div>
                                <div class=" mt-4 ">
                                    <a class="btn btn-remove" href="#">حذف‌<i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection