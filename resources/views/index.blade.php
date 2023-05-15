@extends('master')
@section('content')

@if(Session::has('user_error'))
  <script>
    alert('{{Session::get("user_error")}}');
  </script>
@endif

@if(Session::has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('message')}}
    </div>
@endif

<!-- carousel -->

<div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <?php
        $count=0;
    ?>
    @foreach($productByTime as $item)
        <div class="carousel-item @if($count==0){{'active'}}@endif">
            <div class="text-center carousel-background">
                <img src="images/products/{{$item->category}}/{{$item->image}}" alt="Chicago"class="img-fluid mb-5 carousel-img">
            </div>
            <div class="carousel-caption mt-5">
                <h3 class="txt-shadow">{{$item->name}}</h3>
            </div>
        </div>
        @if($count>2)
            @break
        @else   
            <?php
                $count++;
            ?>
        @endif
        
    @endforeach

  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="next">
    <i class="fas fa-chevron-circle-left crousel-arrow"></i>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="prev">
    <i class="fas fa-chevron-circle-right crousel-arrow"></i>
  </a>
</div>

<!-- categoris -->

<h2 class="Display-2 text-center my-5">دسته‌بندی‌ها</h2>
<div class="container">

  <div class=" d-flex justify-content-center flex-wrap mb-3">
    @foreach($categories as $category)
    <div class=" d-flex justify-content-center flex-column card-size" width="150">
        <div class="d-flex justify-content-center">
            <a href="{{route('products',['category'=>$category->category])}}" class="card-link" style="border-radius: 50%;">
              <div class="card-img-container d-flex justify-content-center align-items-center">
                <img class="card-img-top category-img" src='{{URL::asset("images/category/$category->image")}}' alt="Card image">
              </div>
            </a>
        </div>
        <div>
            <h4 class="text-center">{{$category->category}}</h4>
        </div>
    </div>

    @endforeach
  </div>

    <!-- ///////////////////////////////////////////////////////////////////// -->
</div>

<section class="mx-2 mb-5 bg-second rounded py-2">
    <h2 class="text-center mt-5 mb-3">محبوب ترین ها </h2>
    <div class="swiper mySwiper p-2 ">
        <div class="swiper-wrapper d-flex align-items-center">
            @php $rate_product_counter=0; @endphp
            @foreach($productByRate as $rate)
                <div class="swiper-slide mb-5 rounded">
                    <a href="{{route('product.details',['id'=>$rate->id])}}" class="card-txt">
                        <div class="card p-0 card-index border-0">
                            <img class="img-fluid img-round" src='{{URL::asset("images/products/$rate->category/$rate->image")}}' alt="Card image" style="width:100%;">
                            <div class="text-center">
                                <h4 class="my-2">{{$rate->name}}</h4>
                                <div class="my-3">
                                    @if($rate->rating)
                                        @for($n=0;$n<round($rate->rating);$n++)
                                            <span class="star-container checked-star">
                                                <i class="fa fa-star"></i>
                                           </span>
                                        @endfor
                                    @else
                                        <span>بدون امتیاز</span>
                                    @endif
                                </div>
                                @if($rate->product_status)
                                    <p class="badge text-dark">{{$rate->price}}تومان</p>
                                @else
                                    <p class="badge badge-danger">ناموجود</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @php $rate_product_counter++; @endphp
                @if($rate_product_counter >3)
                    @break
                @endif

            @endforeach
            <div class="swiper-slide mb-5">
                <a href="{{route('most',['column'=>'rating'])}}" class="card-txt">
                    <div class="card p-0 card-index border-0">
                        <div class="bg-second">
                            <i class="fas fa-chevron-circle-left crousel-arrow"></i>
                        </div>
                        <div class="text-center bg-second">
                            <p class="badge text-black">بیشتر</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="mx-2 mb-5 bg-second rounded py-2">
    <h2 class="text-center mt-5 mb-3">پر فروش ترین ها</h2>
    <div class="swiper mySwiper p-2">
        <div class="swiper-wrapper d-flex align-items-center">
            @php $sell_product_counter=0; @endphp
            @foreach($productBySell as $sell)
                <div class="swiper-slide mb-5 rounded">
                    <a href="{{route('product.details',['id'=>$sell->id])}}" class="card-txt ">
                        <div class="card p-0 card-index">
                            <img class="img-fluid img-round" src='{{URL::asset("images/products/$sell->category/$sell->image")}}' alt="Card image" style="width:100%;">
                            <div class="text-center">
                                <h4 class="my-2">{{$sell->name}}</h4>
                                <div class="my-3">
                                    @if($sell->rating)
                                        @for($m=0;$m<round($sell->rating);$m++)
                                            <span class="star-container checked-star">
                                                <i class="fa fa-star"></i>
                                           </span>
                                        @endfor
                                    @else
                                        <span>بدون امتیاز</span>
                                    @endif
                                </div>
                                @if($sell->product_status)
                                    <p class="badge text-dark">{{$sell->price}}تومان</p>
                                @else
                                    <p class="badge badge-danger">ناموجود</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @php $sell_product_counter++; @endphp
                @if($sell_product_counter >3)
                    @break
                @endif

            @endforeach
            <div class="swiper-slide mb-5">
                <a href="{{route('most',['column'=>'sale_quantity'])}}" class="card-txt ">
                    <div class="card p-0 card-index border-0">
                        <div class="bg-second">
                            <i class="fas fa-chevron-circle-left crousel-arrow"></i>
                        </div>
                        <div class="text-center bg-second">
                            <p class="badge text-black">بیشتر</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
      

        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="mx-2 mb-5 bg-second rounded py-2">
    <h2 class="text-center mt-5 mb-3">جدیدترین ها</h2>
    <div class="swiper mySwiper p-2">
        <div class="swiper-wrapper d-flex align-items-center">
            @php $sell_product_counter=0; @endphp
            @foreach($productByTime as $time)
                <div class="swiper-slide mb-5 rounded">
                    <a href="{{route('product.details',['id'=>$time->id])}}" class="card-txt ">
                        <div class="card p-0 card-index">
                            <img class="img-fluid img-round" src='{{URL::asset("images/products/$time->category/$time->image")}}' alt="Card image" style="width:100%;">
                            <div class="text-center">
                                <h4 class="my-2">{{$time->name}}</h4>
                                <div class="my-3">
                                    @if($time->rating)
                                        @for($m=0;$m<round($time->rating);$m++)
                                            <span class="star-container checked-star">
                                                <i class="fa fa-star"></i>
                                           </span>
                                        @endfor
                                    @else
                                        <span>بدون امتیاز</span>
                                    @endif
                                </div>
                                @if($time->product_status)
                                    <p class="badge text-dark">{{$time->price}}تومان</p>
                                @else
                                    <p class="badge badge-danger">ناموجود</p>
                                @endif

                            </div>
                        </div>
                    </a>
                </div>
                @php $sell_product_counter++; @endphp
                @if($sell_product_counter >3)
                    @break
                @endif

            @endforeach
            <div class="swiper-slide mb-5">
                <a href="{{route('most',['column'=>'created_at'])}}" class="card-txt ">
                    <div class="card p-0 card-index border-0">
                        <div class="bg-second">
                            <i class="fas fa-chevron-circle-left crousel-arrow"></i>
                        </div>
                        <div class="text-center bg-second">
                            <p class="badge text-black">بیشتر</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640:{
                slidesPerView:3,
                spaceBetween:20,
            },
            768:{
                slidesPerView:4,
                spaceBetween:30,
            },
            1024:{
                slidesPerView:5,
                spaceBetween:40,
            },
        }
    });
</script>
@endsection
