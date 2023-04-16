@extends('master')
@section('content')
<div class="container">
   <div class="d-flex justify-content-center">
       <div class="col-md-4 my-5">
           <h2 class="my-5 text-center">مدیریت کاربران</h2>
           <div class="user-info-container">
               @foreach($users as $user)
                   <div>
                       <a href="">{{$user->name}}</a>
                   </div>
               @endforeach
           </div>
       </div>
   </div>
</div>
@endsection
