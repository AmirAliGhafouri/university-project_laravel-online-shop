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
                        <img class="img-fluid img-responsive rounded product-image login-img"  src='{{URL::asset("images/admin/category2.png")}}'>
                    </div>
                    <div class="col-lg-6 pl-md-5 form-container p-5 bg-white">
                        <h2 class="display-5 text-center mb-5">افزودن دسته‌بندی جدید</h2>
                        <form action="{{route('addCategory')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-right">
                                <label for="name">نام دسته‌بندی </label>
                                <input type="text" class="form-control @error('category') {{'is-invalid'}} @enderror" id="name" name="category">
                                @error('category')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <label for="pic">تصویر دسته‌بندی </label>
                                <input type="file" class="form-control-file @error('c_image') {{'is-invalid'}} @enderror" id="pic" name="c_image" accept="image/*">
                                @error('c_image')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-eshop px-5">افزودن</button>
                            </div>
                        </form>

                        <h2 class="display-5 text-center my-5">حذف دسته‌بندی </h2>
                        <form action="{{route('removeCategory')}}" method="POST">
                            @csrf
                            <div class="form-group text-right">
                                <select class="form-control" name="category">
                                    @foreach($categories as $ctg)
                                        <option value="{{$ctg->category}}">{{$ctg->category}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-eshop px-5">حذف</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
