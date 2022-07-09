<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return Application|Factory|View
     */
    public function render(): Factory|View|Application
    {
        $lang = str_replace('_', '-', app()->getLocale());

        return view('layouts.app', compact([
            'lang',
            ]));
    }
}
