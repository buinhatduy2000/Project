<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function postComment(Request $request, $id)
    {
        // dd($request->all());

        $comment = Comment::create([
            'idea_id' => $id,
            'content' => $request->comment,
            'parent_id' => Auth::guard('account')->user()->id,
        ]);
        if(!$comment){
            return redirect()->back()->with('error','Comment Not Success');
        }
        return redirect() -> back()->with('message', 'Comment Success');
    }
}
