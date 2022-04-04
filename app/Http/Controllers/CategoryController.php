<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10)->sortByDesc('id');
        return view('category', compact('categories'))->with('i', (request()-> input('page', 1) -1)*10);
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|max:255'
        ]);
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
//        if (! Gate::allows('edit-cate', $account)) {
//            return redirect()->back()->with('error','You can not edit category');
//        }
        $cate = Category::find($id);

        if($cate){
            $request->validate([
                'category_name' => 'required'
            ]);
            $update_cate = $cate->update([
                'category_name' => $request->input('category_name'),
            ]);
            if(!$update_cate){
                return redirect()->back()->with('error','Update Category Not Success');
            }
            return redirect() -> route('category.index')->with('message',  'Update Category Success');
        }
    }

    public function destroy(Request $request, $id, Category $category){
//        if (! Gate::allows('delete-cate', $category)) {
//            return redirect()->back()->with('error','You can not delete category');
//        }
        $cate = Category::find($id);
        if (count($cate->idea) != 0){
            return redirect()->back()->with('error','Delete Category Not Success');
        }
        if($cate){
            $delete_cate = $cate->delete();

            if(!$delete_cate){
                return redirect()->back()->with('error','Delete Category Not Success');
            }
            return redirect() -> route('category.index')->with('message', 'Delete Category Success');
        }

    }
}
