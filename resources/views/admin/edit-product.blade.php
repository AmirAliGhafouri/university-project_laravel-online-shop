@extends('admin/master')
@section('content')

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('success')}}
    </div>
@endif
    <div class="bg-admin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex flex-row-reverse my-5 shadow">
                    <div class="col-lg-6 d-flex justify-content-center align-items-center login-back">
                        <div class="d-flex justify-content-center flex-column text-white">
                            <div class="mb-3">
                                <img class="img-fluid rounded w-100"  src='{{URL::asset("images/products/$product->category/$product->image")}}'>                               
                            </div>
                            <div class="d-flex justify-content-center">
                                <strong class="text-second">نام محصول : </strong>
                                <p> {{$product->name}} </p>
                            </div>

                            <div class="d-flex justify-content-center">
                                <strong class="text-second">قیمت محصول : </strong>
                                <p> {{$product->price}} تومان</p>
                            </div>

                            <div class="d-flex justify-content-center">
                                <strong class="text-second">دسته‌بندی محصول : </strong>
                                <p> {{$product->category}} </p>
                            </div>

                            <div class="d-flex justify-content-center flex-wrap">
                                <strong class="text-second">توضیحات محصول : </strong>
                                <div class="edit-desc text-right"> {{$product->description}} تومان</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-md-5 form-container p-5 bg-white">
                        <h2 class="display-5 text-center mb-5">ویرایش محصول</h2>
                        <form action="{{route('editProduct',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-right">
                                <label for="name">ویرایش نام</label>
                                <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" placeholder="نام جدید . . .">
                                @error('name')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <label for="b_pages">ویرایش قیمت</label>
                                <input type="text" class="form-control @error('price') {{'is-invalid'}} @enderror" id="b_pages" name="price" placeholder="تومان">
                                @error('price')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <label for="ctg">ویرایش دسته‌بندی</label>
                                <select class="form-control" id="ctg" name="category">
                                    @foreach($category as $ctg)
                                        <option value="{{$ctg->category}}">{{$ctg->category}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <label for="description">ویرایش توضیحات</label>
                                <textarea type="text" class="form-control cmt-box @error('description') {{'is-invalid'}} @enderror" id="description" name="description" placeholder="توضیحات جدید . . ."></textarea>
                                @error('description')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <label for="pic">ویرایش تصویر</label>
                                <input type="file" class="form-control-file @error('image') {{'is-invalid'}} @enderror" id="pic" name="image" accept="image/*">
                                @error('image')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-eshop px-5">ثبت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
