@extends('admin/master')
@section('content')

<div class="bg-admin py-5 ">
    <h2 class="text-center bg-white w-75 shadow rounded mx-auto mb-3 py-3">مدیریت محصولات</h2>
    <section class=" product-control-container col-md-10 mx-auto p-0">
        <div class="product-control-search">
            <input type="search" id="search_inp" name="search" placeholder="جستجو ..." class="form-control admin-product-search bg-dark text-white">
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-column bg-dark text-white">
                @foreach($categories as $category)
                    <div class="text-center product-control">
                        <input type="hidden" value="{{$category->category}}">
                        <p class="my-3 px-2">{{$category->category}}</p>
                    </div>
                @endforeach
            </div>
            <div class=" product-info-container p-3 bg-third" id="product_info_container">
                @foreach($products as $product)
                    <div class="d-flex justify-content-center row my-3 ">
                        <div class="col-md-10 shadow">
                            <div class="row p-2 bg-light rounded">
                                <div class="col-md-4 mt-1">
                                    <a href="/details/{{$product->id}}">
                                        <img class="img-fluid rounded shadow"  src='{{URL::asset("images/products/$product->category/$product->image")}}'>
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1 d-flex align-items-center justify-content-center">
                                    <p class="form-center">{{$product->name}}</p>
                                </div>
                                <div class="col-md-3 mt-1 d-flex justify-content-center align-items-center flex-column">
                                    <div>
                                        <a class="btn btn-eshop" href="{{route('edit.view',['id'=>$product->id])}}">ویرایش</a>
                                    </div>
                                    <div class=" mt-4 ">
                                        <div class="btn btn-remove" onclick='remove_product("{{$product->id}}")'>حذف‌<i class="fas fa-trash-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

    <script>
        $('.product-control').on("click",function(){

            $value=$(this).children('input').val();
            $.ajax({
                type:'get',
                url:"{{URL::to('admin/product-control')}}",
                data:{'category':$value},
                success: function(data){
                    $('#product_info_container').html(data);
                }
            });
        });

        $('#search_inp').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type:'get',
            url:"{{URL::to('admin/product-search')}}",
            data:{'search':$value},
            success: function (data){
                $('#product_info_container').html(data);
            }
        });
    });
    </script>
@endsection
