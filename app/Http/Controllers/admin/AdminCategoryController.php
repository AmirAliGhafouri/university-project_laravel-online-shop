<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
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
