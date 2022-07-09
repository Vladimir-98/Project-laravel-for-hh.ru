<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\District\DistrictRequest;
use App\Models\Admin\City;
use App\Models\Admin\District;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DistrictController extends Controller
{
    const PATH = 'admin.districts.';

    public function index(Request $request)
    {
        $sort_id = 'desc';
        $page = '1';
        $districts = District::orderBy('id', $sort_id)->paginate(3);

        return view(self::PATH . 'index', compact([
                'districts',
                'sort_id',
                'page',
            ]
        ));
    }

    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $districts = District::orderBy('id', $sort_id)->paginate(3);

        return view(self::PATH . 'table', compact([
            'districts',
            'sort_id',
            'page'
        ]))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param DistrictRequest $request
     * @return JsonResponse
     */

    public function create(DistrictRequest $request): JsonResponse
    {
        $request->validated();

        $query = District::create($request->all());

        if (!$query) {
            return response()->json(['Не удалось загрузить район!']);
        }

        return response()->json(['success' => 'Район ' . $request->get('name_ru') . ' успешно добавлен!', 'page' => '1', 'sort' => 'desc']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return string
     */
    public function show(Request $request): string
    {
        $delete = false;

        $id = $request->get('id');

        if ($request->get('delete')) {
            $delete = true;
        }

        $cities = City::all();

        $district = District::find($id);

        return view(self::PATH . 'modal', compact([
            'cities',
            'district',
            'delete',
        ]))->render();
    }

    public function showAll(Request $request): string
    {
        $city_id = $request->get('city_id');

        $cities = City::all();

        $districts = District::where('city_id', $city_id)->get();

        return view(self::PATH . 'option', compact([
            'districts',
            'cities',
        ]))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DistrictRequest $request
     * @return JsonResponse
     */

    public function update(DistrictRequest $request): JsonResponse
    {
        $request->validated();

        $id = $request->get('id');

        $query = District::find($id)->fill($request->all())->update();

        if (!$query) {
            return response()->json(['Не удалось обновить район!']);
        }

        return response()->json(['success' => 'Район ' . $request->get('name_ru') . ' успешно обновлен!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * //     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $query = District::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить район!']);
        }
        return response()->json(['success' => 'Район ' . $request->get('name_ru') . ' успешно удалён!']);
    }
}
