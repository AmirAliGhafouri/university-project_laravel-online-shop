@extends('admin/master')
@section('content')
<div class="bg-admin">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-4 text-right my-5 bg-light rounded">
                <h2 class="text-center my-5">تغییر هزینه پست</h2>
                <form action="{{route('delivery.cost')}}" method="POST" class="px-2">
                    @csrf
                    <div class="form-group text-right">
                        <select class="form-control" name="post_name">
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
            <div class="col-md-4 text-right mb-5 bg-light rounded">
                <h2 class="text-center my-5">افزودن نوع جدید پست</h2>
                <form action="{{route('delivery.add')}}" method="POST" class="px-2">
                    @csrf
                    <div class="form-group row">
                        <div class="w-100">
                            <label for="add_post_name" class="col-sm-2 col-form-label" style="white-space: nowrap">نام</label>
                            <input type="text" class="form-control" id="add_post_name" name="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="w-100">
                            <label for="new_post_cost" class="col-sm-2 col-form-label" style="white-space: nowrap">قیمت</label>
                            <input type="text" class="form-control" id="new_post_cost" placeholder="تومان" name="cost">
                        </div>
                    </div>

                    <div class="text-center my-5">
                        <button type="submit" class="btn btn-eshop px-5">افزودن</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-md-4 text-right mb-5 bg-light rounded">
                <h2 class="text-center my-5">حذف</h2>
                <form action="{{route('delivery.remove')}}" method="POST" class="px-2">
                    @csrf
                    <div class="form-group text-right">
                        <select class="form-control" name="post_name">
                            @foreach($posts as $post)
                                <option value="{{$post->post}}">{{$post->post}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center my-5">
                        <button type="submit" class="btn btn-eshop px-5">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
