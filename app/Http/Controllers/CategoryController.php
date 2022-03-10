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

    public function update(Request $request, $id){
        // dd($request->all());
        
        // $categories -> update([
        //     'category_name' => $request->input('category_name'),
        //     '1st_closure_date' => date("Y-m-d H:i:s"),
        //     '2nd_closure_date' => date("Y-m-d H:i:s"),
        // ]);

        $cate = Category::find($id);

        // dd($cate);

        if($cate){
            $update_cate = $cate->update([
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
    }

    public function destroy(Request $request, $id){
        $cate = Category::find($id);
        if($cate){
            $delete_cate = $cate->delete();

            if(!$delete_cate){
                return redirect()->back()->with('error','Xóa Category không thành công');
            }else{
                return redirect() -> route('category.index')->with('message', 'Xóa Category thành công');
            }
        }
       
    }

}
