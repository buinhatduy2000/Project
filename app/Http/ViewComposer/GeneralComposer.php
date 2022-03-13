<?php

namespace App\Http\ViewComposer;

use App\Models\Category;
use Illuminate\View\View;

class GeneralComposer
{

    public function compose(View $view)
    {
        $view->with([
            'category' => Category::all()->sortByDesc('id'),
        ]);
    }

}
