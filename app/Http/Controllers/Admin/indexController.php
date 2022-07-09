<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;

class indexController extends Controller
{
    public function index()
    {

        $sort_id = 'desc';
        $page = '1';
        $projects = Project::orderBy('id', $sort_id)->get();
        $projects = Project::find(2);
        return view('admin.index', compact([
                'projects',
//                'sort_id',
//                'page',
            ]
        ));


    }
}
