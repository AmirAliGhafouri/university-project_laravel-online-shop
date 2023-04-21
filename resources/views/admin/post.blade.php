@extends('admin/master')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-4 text-right my-5">
            <h2 class="text-center my-5">هزینه پست</h2>
            <form action="{{route('delivery.cost')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="w-100">
                        <label for="normal_post" class="col-sm-2 col-form-label" style="white-space: nowrap">پست معمولی</label>
                        <input type="text" class="form-control" id="normal_post" placeholder="تومان" name="normal">
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
