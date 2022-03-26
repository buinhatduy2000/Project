<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Document;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        return view('user.idea.create');
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
        $status = Idea::create([
            'idea_title' => $request->idea_title,
            'user_id' => Auth::guard('account')->user()->id,
            'description' => $request->description ?? '',
            'category_id' => $request->category_id,
        ]);
        $lastInsertId = DB::getPdo()->lastInsertId();
        foreach ($pathFile as $file) {
            Document::create([
                'idea_id' => $lastInsertId,
                'file_name' => $file
            ]);
        }
        if ($status){
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
        $idea = Idea::find($id);

        return view('user.idea.detail', ['idea' => $idea]);
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
}
