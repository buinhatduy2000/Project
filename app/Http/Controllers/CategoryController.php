<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Personal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use App\Exports\CsvExport;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use File;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(5);
        return view('category', ['categories' => $categories]);
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => ['required','max:255', Rule::unique('categories')->whereNull('deleted_at')],
            'category_date' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d')
        ]);
        $cate = Category::create([
            'category_name' => $request->category_name,
            'first_closure_date' => $request->category_date,
            'second_closure_date' => Carbon::createFromFormat('Y-m-d', $request->category_date)->addDays(14),
        ]);
        if(!$cate){
            return redirect()->back()->with('error','Create Category Not Success');
        }
        return response()->json(['success' => 'Create Category Success']);
    }

    public function update(Request $request, $id){
        $cate = Category::find($id);
        if($cate){
            if (Auth::guard('account')->user()->role !== Account::ACCOUNT_ADMIN) {
                $request->validate([
                    'category_name' => ['required','max:255', Rule::unique('categories')->ignore($id)->whereNull('deleted_at')],
//                'category_date' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d')
                ]);
                $update_cate = $cate->update([
                    'category_name' => $request->input('category_name'),
                ]);
            }else {
                $request->validate([
                    // 'category_name' => ['required','max:255', Rule::unique('categories')->ignore($id)->whereNull('deleted_at')],
                    'category_date' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d')
                ]);
                $update_cate = $cate->update([
                    // 'category_name' => $request->input('category_name'),
                    'first_closure_date' => $request->category_date,
                    'second_closure_date' => Carbon::createFromFormat('Y-m-d', $request->category_date)->addDays(14),
                ]);
            }
            if(!$update_cate){
                return redirect()->back()->with('error','Update Category Not Success');
            }
            return response()->json(['success' => 'Update Category Success']);
        }
    }

    public function destroy(Request $request, $id){
//        if (! Gate::allows('delete-cate', $category)) {
//            return redirect()->back()->with('error','You can not delete category');
//        }
        $cate = Category::find($id);
        if ($cate->ideas->count() != 0){
            return redirect()->back()->with('error','Delete Category Not Success');
        }
        if($cate){
            $delete_cate = $cate->delete();

            if(!$delete_cate){
                return redirect()->back()->with('error','Delete Category Not Success');
            }
            return redirect() -> route('category.index')->with('success', 'Delete Category Success');
        }

    }
    public function export_csv(Request $request, $id)
    {
        $cate = Category::with('ideas')->where('id', $id)->first();
        if (!$cate->ideas->count()){
            return redirect()->back()->with('error', 'Campaign '.$cate->category_name. ' do not have ideas');
        }
        $ideas = Idea::where('category_id', $id)
            ->withCount([
                'likeDislikes as likes_count' => function ($query) {
                    $query->where('type', 1);
                },
                'likeDislikes as dislikes_count' => function ($query) {
                    $query->where('type', 0);
                }
            ])->get();
        $arr = [];
        foreach ($ideas as $idea){
            $user = Personal::where('user_id',$idea->user_id)->first();
            $ideaAuthor = ["author"=> $user->first_name .' '. $user->last_name];
            $files = '';
            foreach ($idea->documents as $key => $doc){
                $fileName = explode('/', $doc->file_name);
                $files .= $fileName[2];
                $files .= ', ';
            }
            $ideaFile = ["file" => $files];
            $comments = '';
//            $ideaLike = ["like" => $idea->likes_count];
//            $ideaDisLike = ["dislike" => $idea->dislikes_count];
            // dd($ideaDisLike);
//            $ideaLike = ["like" => $idea->likes_count];

            foreach ($idea->comments as $comment){
                $author = $comment->author->personal_info;
                $comments .= $author->last_name .': '.$comment->content;
                $comments .= "; ";
            }
            $ideaComment = ["comment" => $comments];

            $idea = $idea->toArray();

            $idea = $idea + $ideaAuthor + $ideaFile + $ideaComment;

            unset($idea['id'],$idea['user_id'],$idea['category_id'],$idea['deleted_at'],$idea['updated_at'],$idea['anonymous'],$idea['documents'],$idea['comments']);

            array_push($arr, $idea);
        }
        $export = new CsvExport($arr);
        return Excel::download($export, 'downloads.csv')->deleteFileAfterSend();
    }

    public function downloadCate($id)
    {
        $cate = Category::with('ideas')->where('id', $id)->first();
        if ($cate->ideas->isEmpty()){
            return redirect()->back()->with('error',  $cate->category_name.' has no ideas');
        }
        $zip = new ZipArchive;
        $zipName = 'download_'.$cate->category_name.'.zip';
        foreach ($cate->ideas as $idea){
            if ($zip->open(public_path($zipName), ZipArchive::CREATE)== TRUE)
            {
                foreach ($idea->documents as $item) {
                    $relativeName = basename($item->file_name);
                    $zip->addFile(public_path($item->file_name), $relativeName);
                }
                $zip->close();
            }
        }
        if (file_exists(public_path($zipName))) {
            $headers = ['Content-Type' => 'application/zip', 'Content-Disposition' => 'attachment'];
            return response()->download(public_path($zipName), $zipName, $headers)->deleteFileAfterSend();
        }
    }
}
