@extends('master')
@section('content')
<h2 class="my-5 text-center">{{$category}}:</h2>
<div class="container d-flex justify-content-center flex-wrap my-5">
    @foreach($products as $item)
        <a href="{{route('product.details',['id'=>$item->id])}}" class="card-txt">
            <div class="card card-products mx-2">
                <img class="img-fluid" src='{{URL::asset("images/products/$item->category/$item->image")}}' alt="Card image">
                <div class="text-center">
                    <h4 class="my-2">{{$item->name}}</h4>
                    <div class="my-3">
                        @if($item->rating)
                            @for($m=0;$m<round($item->rating);$m++)
                                <span class="star-container checked-star">
                                                <i class="fa fa-star"></i>
                                           </span>
                            @endfor
                        @else
                            <span>بدون امتیاز</span>
                        @endif
                    </div>
                    <p class="badge text-dark">{{$item->price}}تومان</p>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
