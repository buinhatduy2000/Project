<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return view('category', compact('categories'))->with('i', (request()-> input('page', 1) -1)*10);
    }

    public function store(Request $request){
        // dd($request->all());
        // Category::create($request->all());
        $cate = Category::create([
            'category_name' => $request->input('category_name'),
            '1st_closure_date' => date("Y-m-d H:i:s"),
            '2nd_closure_date' => date("Y-m-d H:i:s"),
        ]);
        if(!$cate){
            return redirect()->back()->with('error','Thêm Category không thành công');
        }else{
            return redirect() -> route('category.index')->with('message', 'Thêm Category thành công');
        }
    }

    public function update(Request $request, Category $categories, $id){
        // dd($request->all());
        
        // $categories -> update([
        //     'category_name' => $request->input('category_name'),
        //     '1st_closure_date' => date("Y-m-d H:i:s"),
        //     '2nd_closure_date' => date("Y-m-d H:i:s"),
        // ]);

        $update_cate = DB::table('categories')->where('id', '=', $id)->update([
            'category_name' => $request->input('category_name'),
            '1st_closure_date' => date("Y-m-d H:i:s"),
            '2nd_closure_date' => date("Y-m-d H:i:s"),
            ]);

            if(!$update_cate){
                return redirect()->back()->with('error','Sửa Category không thành công');
            }
            else{
                return redirect() -> route('category.index')->with('message',  'Sửa Category thành công');
            }  
    }

    public function destroy(Request $request, Category $categories, $id){
        $delete_cate = DB::table('categories')->where('id', '=', $id) -> delete();
        if(!$delete_cate){
            return redirect()->back()->with('error','Xóa Category không thành công');
        }else{
            return redirect() -> route('category.index')->with('message', 'Xóa Category thành công');
        }
    }

}
