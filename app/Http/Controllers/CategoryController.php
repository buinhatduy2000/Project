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

        Category::create([
            'category_name' => $request->input('category_name'),
            '1st_closure_date' => date("Y-m-d H:i:s"),
            '2nd_closure_date' => date("Y-m-d H:i:s"),
        ]);
        return redirect() -> route('category.index')->with('message', 'Thêm Category thành công');
    }

    public function update(Request $request, Category $categories){
        // dd($request->all());
        $categories -> update([
            'category_name' => $request->input('category_name'),
            '1st_closure_date' => date("Y-m-d H:i:s"),
            '2nd_closure_date' => date("Y-m-d H:i:s"),
        ]);
        return redirect() -> route('category.index')->with('message',  'Sửa Category thành công');
    }

    public function destroy(Category $categories){
        $categories -> delete();
        return redirect() -> route('category.index')->with('message', 'Xóa Category thành công');
    }

}
