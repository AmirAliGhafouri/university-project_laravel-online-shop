@extends('admin/master')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-4 text-right my-5">
            <h2 class="text-center my-5">تغییر هزینه پست</h2>
            <form action="{{route('delivery.cost')}}" method="POST">
                @csrf
                <div class="form-group text-right">
                    <label for="delivery">دستبه‌بندی</label>
                    <select class="form-control" id="delivery" name="post_name">
                        @foreach($posts as $post)
                            <option value="{{$post->post}}">{{$post->post}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group row">
                    <div class="w-100">
                        <input type="text" class="form-control" placeholder="تومان" name="cost">
                    </div>
                </div>
        

                <div class="text-center my-5">
                    <button type="submit" class="btn btn-eshop px-5">تغییر</button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-md-4 text-right mb-5">
            <h2 class="text-center my-5">افزودن نوع جدید پست</h2>
            <form action="{{route('delivery.cost')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="w-100">
                        <label for="normal_post" class="col-sm-2 col-form-label" style="white-space: nowrap">نام</label>
                        <input type="text" class="form-control" id="normal_post" name="normal">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="w-100">
                        <label for="express_post" class="col-sm-2 col-form-label" style="white-space: nowrap">پست سریع</label>
                        <input type="text" class="form-control" id="express_post" placeholder="تومان" name="express_post">
                    </div>
                </div>

                <div class="text-center my-5">
                    <button type="submit" class="btn btn-eshop px-5">تغییر</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
