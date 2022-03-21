<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10)->sortByDesc('id');
        return view('category', compact('categories'))->with('i', (request()-> input('page', 1) -1)*10);
    }

    public function store(Request $request){

        $cate = Category::create([
            'category_name' => $request->category_name,
            'first_closure_date' => Carbon::now(),
            'second_closure_date' => Carbon::now()->addDays(14),
        ]);
        if(!$cate){
            return redirect()->back()->with('error','Create Category Not Success');
        }
        return redirect() -> route('category.index')->with('message', 'Create Category Success');

    }

    public function update(Request $request, $id){

        $cate = Category::find($id);

        if($cate){
            $update_cate = $cate->update([
                'category_name' => $request->input('category_name'),
            ]);
            if(!$update_cate){
                return redirect()->back()->with('error','Update Category Not Success');
            }
            return redirect() -> route('category.index')->with('message',  'Update Category Success');
        }
    }

    public function destroy(Request $request, $id){
        $cate = Category::find($id);
        if($cate){
            $delete_cate = $cate->delete();

            if(!$delete_cate){
                return redirect()->back()->with('error','Delete Category Not Success');
            }
            return redirect() -> route('category.index')->with('message', 'Delete Category Success');
        }

    }

}
