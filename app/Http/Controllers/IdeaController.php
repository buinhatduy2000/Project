<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Document;
use App\Models\Idea;
use App\Models\Comment;
use App\Models\Account;
use App\Models\Personal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\SubmitIdea;
use Illuminate\Support\Facades\Mail;
use ZipArchive;
use File;

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
        // dd($request->all());
        $destinationPath = '/uploads/';
        if (!is_dir(public_path(). '/uploads/')){
            mkdir(public_path().'/uploads', '0777');
        }
        $pathFile = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $files) {
                $fileName = date('Ymd') . Str::random(5) . "." . $files->getClientOriginalExtension();
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
            'anonymous' => $request->anonymous,
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
            $users = Account::with(['personal_info' => function($q) use ($department) {
                $q->where('personal_info.department', '=', $department);
            }])->where('role', Account::ACCOUNT_QAC)->get();

            foreach ($users as $key => $user){
                if (!$user->personal_info){
                    $users->forget($key);
                }
            }
            $category_mail = Category::where('id', $request->category_id)->first();

            foreach($users as $user){
                $email_QAC = $user->personal_info->email;
                $mailable = new SubmitIdea($user, $category_mail);
                Mail::to($email_QAC)->send($mailable);
            }

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
    public function downloadIdea($id)
    {
        $files = Idea::with('documents')->find($id);
        if (!$files){
            return response()->json(['error'  => 'Idea do not exist']);
        }
        $zip = new ZipArchive;
        $zipName = 'download_'.$files->idea_title.'.zip';
        if (!is_dir(public_path(). '/zip/')){
            mkdir(public_path().'/zip', '0777');
        }
        if ($zip->open(public_path('/zip/'.$zipName), ZipArchive::CREATE)== TRUE)
        {
            foreach ($files->documents as $item) {
                $relativeName = basename($item->file_name);
                $zip->addFile(public_path($item->file_name), $relativeName);
            }
            $zip->close();
        }
        if (file_exists(public_path('/zip/'.$zipName))) {
            $headers = ['Content-Type' => 'application/zip', 'Content-Disposition' => 'attachment'];
            return response()->download(public_path('/zip/'.$zipName), $zipName, $headers);
        }
    }
}
