<?php

use App\Http\Controllers\productController;
use App\Models\category;
use App\Models\User;
use Illuminate\Support\Facades\Session;
////////////////////////////////////
  $categories=category::all();

  //Auth
  $admin=false;
  $logged=false;
  if(Session::has('user')){
    $logged=true;

    $username=User::where('id',Session::get('user')['id'])->first()->name;
  }

?>
<header>
  <!------------------ TopBar ------------------>
  <nav class="navbar navbar-expand-md bg-dark">
    <!-------- LOGO -------->
    <a class="navbar-brand" href="{{route('home')}}" title="صفحه ی اصلی"><img src="{{URL::asset('images/backgrounds/eshop_logo.png')}}" alt="لوگوی فروشگاه" class="site-logo"></a>
    <!-------- Navbar toggler -------->
    <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars menu-icon"></i>
    </button>

    <div class="search-container d-flex">
      <!-------- Search Box -------->
        <div class="main-search ">
            <form action="{{route('search')}}" method="POST" class="form-inline my-lg-0 my-2 search-form">
                @csrf
                <input class="form-control mr-sm-2 search-inp" type="search" placeholder="جستجو . . ." aria-label="Search" name="search" id="search_inp">
                <button class="btn my-2 my-sm-0 search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div id="content" class="search-result-container"></div>
        </div>
      <!-------- Account button -------->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              @if(!$logged)
                <a class="nav-link account mx-2 px-2" href="{{route('login.view')}}">ثبت‌نام | ورود <i class="fas fa-user-alt"></i></a>
              @else
                <a class="nav-link account mx-2 px-2" href="{{route('logout')}}">خروج <i class="fa-solid fa-right-from-bracket"></i></a>
              @endif
            </li>
        </ul>

        <div class="text-right mr-2">
            <a href="{{url()->previous()}}" class="btn btn-back text-white">بازگشت</a>
        </div>
    </div>
  </nav>

  <!------------------ Menu List ------------------>
  <nav class="navbar navbar-expand-md bg-dark ">
    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto p-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}" title="صفحه ی اصلی"><i class="fas fa-home"></i> خانه <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-2" href="#" role="button" data-toggle="dropdown" aria-expanded="false" title="دسته بندی محصولات">
             دسته‌بندی‌ها
          </a>
          <div class="dropdown-menu text-center">

              @foreach($categories as $category)
                <a class="dropdown-item" href="{{route('products',['category'=>$category->category])}}">{{$category->category}}</a>
              @endforeach
          </div>
        </li>

        @if($logged)
          <li class="nav-item ml-2">
              <a class="nav-link drop-link " href="{{route('cartList')}}" title="سبد خرید"><i class="fa-solid fa-cart-shopping"></i> سبد خرید({{productController::cart_count()}})</a>
          </li>

          <li class="nav-item ml-2">
              <a class="nav-link drop-link " href="{{route('user.panel')}}" title="پنل کاربری">{{$username}}<i class="fa fa-user"></i></a>
          </li>
        @endif


      </ul>
    </div>
  </nav>
</header>
<script type="text/javascript">
    $('#search_inp').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type:'get',
            url:"{{URL::to('search-live')}}",
            data:{'search':$value},
            success: function (data){
                $('#content').html(data);
            }
        });
    });
</script>
