<?php

namespace App\Http\Controllers;

use App\Filters\ProjectFilter;
use App\Models\Admin\Apartments;
use App\Models\Admin\City;
use App\Models\Admin\District;
use App\Models\Admin\Page;
use App\Models\Admin\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class FilterController extends Controller
{

    /**
     *
     * @param Request $request
     * @return string
     */
    public function addFilterDistricts(Request $request): string
    {
        $districts = [];
        $city = false;

        if ($request->get('city_id') && $request->get('city_id') != 'all') {
            $city_id = $request->get('city_id');
            $city = City::find($city_id);
            $districts = $city->districts;
        }

        return view('layouts.filter-district', compact([
            'districts',
            'city'
        ]))->render();
    }

    /**
     *
     * @param ProjectFilter $request
     * @param Request $request_std
     * @return string
     */

    public function getFilter(ProjectFilter $request, Request $request_std): string
    {

        $date = Carbon::now();
        $projects = '';
        $apartments = '';
        $page_id = $request_std->get('page_id');
        $operator = $request_std->get('operator');
        $blade = 'projects';
        $curr_page = '';

        if ($operator) {
            $projects = Project::filter($request)
                ->where('deadline', $operator, $date)
                ->paginate(2)->withQueryString();
            if ($operator == '<') {
                $curr_page = 'old-projects';
            } else {
                $curr_page = 'new-projects';
            }

        } else {
            $apartments = Apartments::filter($request)->paginate(3)->withQueryString();
            $blade = 'apartments';
        }

        $page = Page::find($page_id);
        $city = '';
        $district = '';
        $desc_id = '';

        if ($request_std->get('id')) {
            $desc_id = $request_std->get('id');
        }

        $desc_price = '';

        if ($request_std->get('price')) {
            $desc_price = $request_std->get('price');
        }

        if ($request_std->get('city_id')) {
            $city = City::find($request_std->get('city_id'));
        }

        if ($request_std->get('district_id')) {
            $district = District::find($request_std->get('district_id'));
        }

        return view('layouts.' . $blade, compact([

            'projects',
            'apartments',
            'page',
            'city',
            'district',
            'operator',
            'desc_price',
            'desc_id',
            'curr_page'

        ]))->render();
    }
}
