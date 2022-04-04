<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Document;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\SubmitIdea;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('idea.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IdeaRequest $request)
    {
        $destinationPath = '/uploads/';
        if (!is_dir(public_path(). '/uploads/')){
            mkdir(public_path().'/uploads', '0777');
        }
        $pathFile = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $files) {
                $fileName = time() . Str::random(5) . "." . $files->getClientOriginalExtension();
                $files->move(public_path() . $destinationPath, $fileName);
                $pathFile[] = $destinationPath . $fileName;
            }
        }
        $department = Auth::guard('account')->user()->personal_info->department;
        $status = Idea::create([
            'idea_title' => $request->idea_title,
            'user_id' => Auth::guard('account')->user()->id,
            'description' => $request->description ?? '',
            'category_id' => $request->category_id,
            'department' => $department,
            'views' => 0,
        ]);
        $lastInsertId = DB::getPdo()->lastInsertId();
        foreach ($pathFile as $file) {
            Document::create([
                'idea_id' => $lastInsertId,
                'file_name' => $file
            ]);
        }
        if ($status){
            // $user = Personal::find($idea['user_id']);

            // $mailable = new SubmitIdea($user);
            // Mail::to($user['email'])->send($mailable);
            return redirect()->route('viewInfo', ['id' => Auth::guard('account')->user()->id])->with('success', "Create successful");
        }
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idea = Idea::with('documents')->find($id);
        if (!$idea){
            return redirect()->route('viewInfo', ['id' => Auth::guard('account')->user()->id])->with('error', "Idea do not exist");
        }

        $comments = Comment::where('idea_id', $id)->get();

        $idea->increment('views');

        return view('idea.detail', ['idea' => $idea, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idea  $ideal
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $ideal, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idea  $ideal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $ideal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idea  $ideal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $ideal)
    {
        //
    }

    public function likeIdea(Request $request)
    {
        $idea = Idea::find($request->id);
        $account = Auth::guard('account')->user();
        $response = $account->toggleLike($idea);
        $likes = $idea->likers()->count();

        return response()->json(['success'=>$response, 'likes'=>$likes]);
    }
}
