@extends('master')
@section('content')

@if(Session::has('sucessMessage'))
	<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('sucessMessage')}}
    </div>
@endif
<div class="container">
    <div class="row my-5 d-flex flex-row-reverse">
		<div class="col-lg-6 mb-5">
    		<img src='{{URL::asset("images/products/$details->category/$details->image")}}' class="img-fluid detail-img shadow" alt="{{$details->name}}">

            <!-- Rating -->

            @if($allow_rate)
                @if($rate)
                    <div class="my-5 d-flex justify-content-center">
                        <p>امتیاز شما به این محصول : </p>
                        @for($i=1 ; $i<=$rate ;$i++)
                            <span class="checked-star"><i class="fa fa-star"></i></span>
                        @endfor
                    </div>
                @else
                <div class="my-5 d-flex justify-content-center">
                    <div class="ml-3">
                        <p>
                            لطفا به این محصول امتیاز دهید:
                        </p>
                    </div>
                    <div>
                        <span class="star-container" id="star1" data-attr="1">
                            <i class="fa fa-star"></i>
                        </span>

                        <span class="star-container" id="star2" data-attr="2">
                            <i class="fa fa-star"></i>
                        </span>

                        <span class="star-container" id="star3" data-attr="3">
                            <i class="fa fa-star"></i>
                        </span>

                        <span class="star-container" id="star4" data-attr="4">
                            <i class="fa fa-star"></i>
                        </span>

                        <span class="star-container" id="star5" data-attr="5">
                            <i class="fa fa-star"></i>
                        </span>


                    </div>

                    <div>
                        <p id="rating_value" class="mr-2"></p>
                    </div>
                </div>
                @endif

            @endif

    	</div>
        <div class="col-lg-6 product-details pl-md-5 text-justify">
    		<h2 class="display-4 mb-3">{{$details->name}}</h2>

			<p>{{$details->description}}</p>
          	<div class=" mt-2">
                <strong class="mb-5">{{$details->price}}تومان</strong>
				<a href="{{route('add.cart',['id'=>$details->id])}}" class="btn btn-eshop">افزودن‌به‌سبد‌خرید <i class="fa-solid fa-cart-plus"></i></a>
			</div>
    	</div>
    </div>

</div>

<script>
    $('.star-container').on("click",function(){
        $value=$(this).attr("data-attr");
        $pid="{{$details->id}}";

        $.ajax({
            type:'get',
            url:"{{URL::to('product-rate')}}",
            data:{'rating':$value , 'pid':$pid},
            success:function(data){
                $('#rating_value').html(data);
                let i=0;
                for ( i = 1; i <= data; i++) {
                    $("#star"+i).css('color','gold');
                }

                for (let c = i; c <= 5; c++) {
                    $("#star"+c).css('color','silver');
                }
            }
        });
    });
</script>

@endsection
