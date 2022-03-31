<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Personal;
use App\Models\Idea;
use App\Mail\HelloMail;

class CommentController extends Controller
{
    public function postComment(Request $request, $id)
    {
        // dd($request->all());

        $comment = Comment::create([
            'idea_id' => $id,
            'content' => $request->comment,
            'account_id' => Auth::guard('account')->user()->id,
            'anonymous' => $request->anonymous,
        ]);
        if(!$comment){
            return redirect()->back()->with('error','Comment Not Success');
        }
        // dd('send mail');\
        $idea = Idea::find($id);
        Idea::find($id)->increment('comments');
        $user = Personal::find($idea['user_id']);
        // dd($user['email']);
        $mailable = new HelloMail($user);
        Mail::to($user['email'])->send($mailable);
        
        return redirect() -> back()->with('message', 'Comment Success');
    }
}
