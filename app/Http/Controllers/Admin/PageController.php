<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;

class PageController extends Controller
{
    const PATH = 'admin.pages.';

    public function show($id)
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'show', compact([
            'page'
        ]));

    }





}
