<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ideas = Idea::all()->where('deleted_at', null);
        return view('home', ['ideas' => $ideas]);
    }
}
