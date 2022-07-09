<?php

namespace App\Http\Controllers;

use App\Models\Admin\Apartments;
use App\Models\Admin\News;
use App\Models\Admin\Page;
use App\Models\Admin\Project;
use App\Models\Admin\Questions;
use Carbon\Carbon;

class IndexController extends Controller
{
    //

    public function index()
    {
        $date = Carbon::now();
        $new_projects = Project::where('deadline', '<', $date)->limit(6)->get();
        $old_projects = Project::where('deadline', '>', $date)->limit(6)->get();
        $apartments = Apartments::limit(6)->get();
        $questions = Questions::limit(6)->get();
        $news = News::limit(3)->get();
        $page = Page::find(1);
        return view('index', compact([
            'new_projects',
            'old_projects',
            'apartments',
            'questions',
            'news',
            'page',
        ]));
    }
}
