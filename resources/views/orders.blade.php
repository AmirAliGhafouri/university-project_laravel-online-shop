@extends('master')
@section('content')
    <div class="container my-5">
        <h1 class="display-5 text-center">نهایی کردن سفارش :</h1>
        <div class="row mt-5 pt-3 d-flex flex-row-reverse">
            <div class="col-md-6">
                    <div class=" p-3 p-md-4">
                        <h3 class="text-center mb-4">جزئیات پرداخت</h3>
                        <p class="d-flex justify-content-around my-5">
                            <span>جمع هزینه ها</span>
                            <span>{{$total_price}}تومان</span>
                        </p>
                        <hr>
                        <p class="d-flex justify-content-around my-5">
                            <span>هزینه ارسال</span>
                            <span><span id="post_cost">{{$posts[0]->cost}} </span>تومان</span>
                        </p>

                    </div>
                </div>
	          	<div class="col-md-6">
	          		<div class="p-3 p-md-4">
	          			<h3 class="text-center mb-4">آدرس و شیوه ی پرداخت</h3>
                        <form action="{{route('order')}}" method="POST">
                            @csrf
                            <div class="form-group text-right">
                                <label for="post">شیوه ارسال :</label>
                                <select class="form-control" id="post" name="delivery">
                                    @foreach($posts as $post)
                                        <option value="{{$post->post}}">{{$post->post}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control @error('address') {{'is-invalid'}} @enderror cmt-box" name="address" rows="3" placeholder="آدرس خود را وارد کنید . . ."></textarea>
                                @error('address')
                                    <div id="validationServer03Feedback" class="invalid-feedback text-right">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio text-right">
                                        <label><input type="radio" name="payment" class="mr-2" value="پرداخت آنلاین" checked>پرداخت آنلاین</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio text-right">
                                        <label><input type="radio" name="payment" class="mr-2" value="پرداخت درب منزل">پرداخت هنگام تحویل کالا</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-eshop px-5" type="submit">پرداخت</button>
                            </div>
                        </form>
					</div>
	          	</div>
            </div>
    </div>

    <script>
        $('#post').on("change",function(){
            $value=$(this).val();
            $.ajax({
                type:'get',
                url:"{{URL::to('order-post-cost')}}",
                data:{'post':$value},
                success: function(data){
                    $('#post_cost').html(data['cost']);
                }
            });

        });
    </script>
@endsection
