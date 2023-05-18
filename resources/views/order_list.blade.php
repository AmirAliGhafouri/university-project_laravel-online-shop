@extends('master')
@section('content')
    <div class="form-back-ground">
        <div class="container  py-5">
            <h2 class=" mb-3 text-center py-4 text-white bg-dark rounded">سفارش ها</h2>

            <table class="table text-center bg-white shadow">
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

            <h3 class="text-center my-4 py-4 text-white bg-dark rounded">جزئیات سفارش</h3>
            <div class="d-flex justify-content-center">
                <table class="table text-center border w-100 bg-second">
                    <tr>
                        <td>کد سفارش</td>
                        <td>{{$info->orderCode}}</td>
                    </tr>

                    <tr>
                        <td>نوع پرداخت</td>
                        <td>{{$info->payment_method}}</td>
                    </tr>

                    <tr>
                        <td>نوع ارسال</td>
                        <td>{{$info->delivery_type}}</td>
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
        </div>
    </div>

@endsection

