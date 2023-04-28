<?php

namespace App\Http\Controllers;


use App\Models\category;
use App\Models\order;
use App\Models\post;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class adminController extends Controller
{
    function admin_panel(){
        $date= date('Y-m-d h:m:s');
        $money=DB::table('orders')
            ->join('products','orders.product_id','=','products.id')
            ->where('orders.created_at',$date)
            ->sum('products.price');

        $user_count=User::all()->count();
        $admin=Session::get('user')['name'];

        //////////////

//        $categories=category::all();
//        $product=product::where('category','موبایل')->get();

        /////////////

//        $users=User::all();
        return view('admin/admin-panel',['users_count'=>$user_count , 'money'=>$money , 'admin'=>$admin ]);
    }

    //___________________________________________ product Controller
    function product_management(){
        $categories=category::all();
        $product=product::where('category','موبایل')->get();
        return view('admin/product-management' , [ 'categories'=>$categories , 'products'=>$product]);
    }
    function product_control(Request $req){
        $output="";
        $products=product::where('category',$req->category)->get();
        if($products){
           foreach($products as $product){
               $image=URL::asset("images/products/$product->category/$product->image");
               $output.='
               <div class="d-flex justify-content-center row my-3 ">
                            <div class="col-md-10 shadow">
                                <div class="row p-2 bg-light rounded">
                                    <div class="col-md-4 mt-1">
                                        <a href="/details/'.$product->id.'">
                                            <img class="img-fluid rounded shadow"  src='.$image.'>
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1 d-flex align-items-center justify-content-center">
                                        <p class="form-center">'.$product->name.'</p>
                                    </div>
                                    <div class="col-md-3 mt-1 d-flex justify-content-center align-items-center flex-column">
                                        <div>
                                            <a class="btn btn-eshop" href="'.route("edit.view",$product->id).'">ویرایش</a>
                                        </div>
                                        <div class=" mt-4 ">
                                            <a class="btn btn-remove" href="#">حذف‌<i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
               ';
           }
        }
        return $output;
    }

    //__________________________________________ Edit product 
    function edit_product_view($id){
        try{
            $product=product::where('id',$id)->first();
        }
        catch(\Exception $exception){
            abort(404);
        }
        $ctg=category::all();
        return view('admin/edit-product',['product'=>$product , 'category' =>$ctg]);
    }
    function edit_product(Request $req , $id){
        $req->validate([
            'price'=>'numeric',
            'image'=>'image'
        ]); 

        $newProduct= new product;
        if($req->name)
            product::where('id',$id)->update(['name'=>$req->name]); 
        if($req->price) 
            product::where('id',$id)->update(['price'=>$req->price]);
        if($req->description) 
            product::where('id',$id)->update(['description'=>$req->description]);
        
        product::where('id',$id)->update(['category'=>$req->category]);

        if($req->file('image')){
            $file=$req->file('image');
            $productname=$file->getClientOriginalName();
            $dstPath=public_path()."/images/products/$req->category";
            $file->move($dstPath,$productname);
        }

        return redirect()->route('editProduct',['id'=>$id])->with('success','تغییرات با موفقیت اعمال شدند');
    }

    //__________________________________________ Remove product 
    function remove_product($id){
        try{
            product::destroy($id);
        }
        catch(\Exception $exception){
            abort(404);
        }
        return redirect()->route('product.management')->with('success','محصول مورد نظر با موفقیت حذف شد');
    }

    //__________________________________________ Search product 
    function search_product(Request $req){
        $output="";
        $products=product::where('name','like','%'.$req->search.'%')->get();
        if(!$products->all()){
            $output="<div class="."text-center".">محصولی یافت نشد!</div>";
            return $output;
        }
        else{
           foreach($products as $product){
               $image=URL::asset("images/products/$product->category/$product->image");
               $output.='
               <div class="d-flex justify-content-center row my-3 ">
                            <div class="col-md-10 shadow">
                                <div class="row p-2 bg-light rounded">
                                    <div class="col-md-4 mt-1">
                                        <a href="/details/'.$product->id.'">
                                            <img class="img-fluid rounded shadow"  src='.$image.'>
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1 d-flex align-items-center justify-content-center">
                                        <p class="form-center">'.$product->name.'</p>
                                    </div>
                                    <div class="col-md-3 mt-1 d-flex justify-content-center align-items-center flex-column">
                                        <div>
                                            <a class="btn btn-eshop" href="'.route("edit.view",$product->id).'">ویرایش</a>
                                        </div>
                                        <div class=" mt-4 ">
                                            <a class="btn btn-remove" href="#">حذف‌<i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
               ';
           }
           return $output;
        }
        
    }

    //__________________________________________Add New product
    function add_product_view(){
        $category=category::all();
        return view('admin/add-product',['category'=>$category]);
    }
    function add_product(Request $req){
        $req->validate([
            'name'=>'required',
            'price'=>'required | numeric',
            'description'=>'required',
            'image'=>'required|image'
        ]);

        //save image
        $file=$req->file('image');
        $productname=$file->getClientOriginalName();
        $dstPath=public_path()."/images/products/$req->category";
        $file->move($dstPath,$productname);

        $newProduct= new product;
        $newProduct->name=$req->name;
        $newProduct->price=$req->price;
        $newProduct->category=$req->category;
        $newProduct->description=$req->description;
        $newProduct->sale_quantity=0;
        $newProduct->rating=0;
        $newProduct->image=$productname;
        $newProduct->save();

        return redirect()->route('admin.panel')->with('success',' ✅محصول جدید با موفقیت اضافه شد');
    }

    //__________________________________________ Delivery 
    function delivery(){
        $post=post::all();
        return view('admin/post',['posts'=>$post]);
    }
    function delivery_cost(Request $req){
        post::where('post',$req->post_name)->update(['cost'=>$req->cost]);      
        return redirect()->route('admin.panel')->with('success',' ✅هزینه پست با موفقیت بروزرسانی شد');
    }
    function delivery_add(Request $req){
        $newDelivery= new post();
        $newDelivery->post=$req->name;
        $newDelivery->cost=$req->cost;
        $newDelivery->save();
        return redirect()->route('admin.panel')->with('success','  ✅پست با موفقیت ثبت شد');
    }
    function delivery_remove(Request $req){
        post::where('post',$req->post_name)->delete();
        return redirect()->route('admin.panel')->with('success','  ✅پست با موفقیت حذف شد');
    }

    //__________________________________________ User Controller
    function users(){
        $users=User::all();
        return view('admin/users-management',['users'=>$users]);
    }
    function users_info($id){
        try{
            $user=User::findOrFail($id);
        }
        catch(\Exception $exception){
            abort(404);
        }
        $orders= DB::table('orders')
        ->where('user_id' , $id)
        ->select('orderCode','created_at',DB::raw('count("orderCode") as occurences'))
        ->groupBy('orderCode','created_at')
        ->having('occurences', '>', 0)
        ->get();
        return view('admin/user-info',['user'=>$user , 'orders'=>$orders]);
    }
    static function order_group_list($order,$user_id){
        $joined_order=DB::table('orders')
        ->join('products' , 'orders.product_id' , '=' , 'products.id')
        ->where(['orders.user_id'=>$user_id , 'orders.orderCode'=>$order])
        ->select('products.*','orders.*')
        ->get();
        return $joined_order;
    }

    //__________________________________________ Add ADMIN
    function add_admin(Request $req){
        $req->validate([
            'name'=>'required | regex:/(^([a-zA-z0-9 آ-ی]+)(\d+)?$)/u ',
            'email'=>'required |unique:users| email',
            'pswd'=>'required | min:4 | max:8'
        ]);

        $user=new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->admin=1;
        $user->password=Hash::make($req->pswd);
        $user->save();

        return view('admin/add-admin' , ['success'=>'ادمین جدید با موفقیت اضافه شد']);
    }

    //__________________________________________ Add category
    function add_category(Request $req){
        $req->validate([
            'name'=>'required|unique:category',
            'c_image'=>'required|image'
        ]);

        //save image
        $file=$req->file('c_image');
        $ctgname=$file->getClientOriginalName();
        $dstPath=public_path()."/images/category";
        $file->move($dstPath,$ctgname);

        //Make Folder
        $img_path=public_path()."/images/products/$req->category";
        File::makeDirectory($img_path);

        $newctg= new category;
        $newctg->category=$req->name;
        $newctg->image="$ctgname";
        $newctg->save();

        return view('admin/add-category' , ['success','دسته‌بندی جدید با موفقیت ثبت شد']);
    }

}
