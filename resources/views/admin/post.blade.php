@extends('admin/master')
@section('content')
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{Session::get('success')}}
    </div>
@endif
<div class="bg-admin py-5">
    <div class=" mx-5 d-flex justify-content-center">
        <div class="bg-light w-100">
            <table class="table text-center table-font">
                <tr class="bg-dark text-white">
                    <th>نوع پست</th>
                    <th>قیمت</th>
                </tr>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->post}}</td>
                    <td>{{$post->cost}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-center">
        <div class="d-flex justify-content-center col-md-3 rounded bg-light m-4">
            <div class=" text-right my-5 w-100">
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

                    <div class="form-group">
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

        <div class="d-flex justify-content-center col-md-3 rounded bg-light m-4">
            <div class="text-right mb-5 w-100">
                <h2 class="text-center my-5">افزودن نوع جدید پست</h2>
                <form action="{{route('delivery.add')}}" method="POST" class="px-2">
                    @csrf
                    <div class="form-group">
                        <div class="w-100">
                            <label for="add_post_name" class="col-sm-2 col-form-label" style="white-space: nowrap">نام</label>
                            <input type="text" class="form-control" id="add_post_name" name="name">
                        </div>
                    </div>

                    <div class="form-group">
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

        <div class="d-flex justify-content-center col-md-3 bg-light rounded m-4">
            <div class="text-right mb-5 w-100">
                <h2 class="text-center my-5">حذف</h2>
                <form action="{{route('delivery.remove')}}" method="POST" class="px-2 ">
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
