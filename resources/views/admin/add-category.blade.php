@extends('admin/master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex flex-row-reverse my-5 shadow">
                    <div class="col-lg-6 d-flex justify-content-center align-items-center login-back">
                        <img class="img-fluid img-responsive rounded product-image login-img"  src='{{URL::asset("images/admin/category2.png")}}'>
                    </div>
                    <div class="col-lg-6 pl-md-5 form-container p-5">
                        <h2 class="display-5 text-center mb-5">افزودن دسته‌بندی جدید</h2>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-right">
                                <label for="name">نام دسته‌بندی </label>
                                <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name">
                                @error('name')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <label for="pic">تصویر دسته‌بندی </label>
                                <input type="file" class="form-control-file @error('image') {{'is-invalid'}} @enderror" id="pic" name="image" accept="image/*">
                                @error('image')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-eshop px-5">افزودن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
