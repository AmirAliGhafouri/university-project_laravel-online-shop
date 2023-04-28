@extends('admin/master')
@section('content')
<div class="bg-admin py-5">
    <div class="container">
        <div>
            <h2 class="text-center w-75 bg-white shadow py-3 mx-auto mb-5">مدیریت کاربران</h2>
            @foreach($users as $user)
                <div class="d-flex justify-content-center my-3 row">
                    <div class="col-md-8 shadow">
                        <div class="row p-2 bg-light rounded d-flex justify-content-between">
                            <div class="col-md-3 mt-1 d-flex justify-content-center">
                                <div class="d-flex justify-content-center align-items-center rounded-circle bg-third text-white username-prf">
                                    <i>{{$user->name}}</i>
                                </div>
                            </div>
                            
                            <div class="col-md-2 mt-1 d-flex justify-content-center align-items-center flex-column">
                                <div>
                                    <a class="btn btn-eshop" href="{{route('userInfo.view',['id'=>$user->id])}}">اطلاعات </a>
                                </div>
                                <div class=" mt-4 ">
                                    <a class="btn btn-remove" href="{{route('user.remove',['id'=>$user->id])}}">حذف‌<i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
