<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityRequest;
use App\Models\Admin\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{

    const PATH = 'admin.cities.';

    public function index()
    {
        $sort_id = 'desc';
        $page = '1';
        $cities = City::orderBy('id', $sort_id)->paginate(5);

        return view(self::PATH . 'index', compact([
                'cities',
                'sort_id',
                'page',
            ]
        ));
    }

    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $cities = City::orderBy('id', $sort_id)->paginate(5);

        return view(self::PATH . 'table', compact([
            'cities',
            'sort_id',
            'page'
        ]))->render();
    }

    /**
     * Show the form for creating a new resource.
     * @param CityRequest $request
     * @return JsonResponse
     */
    public function create(CityRequest $request): JsonResponse
    {
        $request->validated();

        $query = City::create($request->all());

        if (!$query) {
            return response()->json(['Не удалось загрузить город!']);
        }

        return response()->json(['success' => 'Город ' . $request->get('name_ru') . ' успешно добавлен!', 'page' => '1', 'sort' => 'desc']);

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

        $city = City::find($id);

        return view(self::PATH . 'modal', compact([
            'city',
            'delete',
        ]))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @return JsonResponse
     */

    public function update(CityRequest $request): JsonResponse
    {
        $request->validated();

        $id = $request->get('id');

        $query = City::find($id)->fill($request->all())->update();

        if (!$query) {
            return response()->json(['Не удалось обновить город!']);
        }

        return response()->json(['success' => 'Город ' . $request->get('name_ru') . ' успешно обновлен!']);
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

        $query = City::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить город!']);
        }
        return response()->json(['success' => 'Город ' . $request->get('name_ru') . ' успешно удалён!']);
    }
}
