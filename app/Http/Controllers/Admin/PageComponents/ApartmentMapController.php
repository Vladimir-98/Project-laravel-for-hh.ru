<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Map\MapRequest;
use App\Models\Admin\Apartments;
use App\Models\Admin\ProjectApartmentMap;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ApartmentMapController extends Controller
{
    const PATH = 'admin.apartments.components.';

    /**
     * @param $id
     * @return string
     */

    public function map($id): string
    {
        $apartment = Apartments::find($id);

        if ( !$apartment ) { abort(404); }

        return view(self::PATH . 'map', compact([
            'apartment'
        ]))->render();

    }

    /**
     * @param MapRequest $request
     * @return JsonResponse
     */

    public function mapUpdate(MapRequest $request): JsonResponse
    {

        $map_id = $request->get('map_gable_id');
        $map_type = $request->get('map_gable_type');
        $map_table = $request->all();

        $map = ProjectApartmentMap::where('map_gable_id', $map_id)->where('map_gable_type', $map_type)->first();

        if ($map !== null) {

            $query = $map->fill($map_table)->update();

        } else {
            $query = ProjectApartmentMap::create($map_table);
        }


        if (!$query) {
            return response()->json(['Не удалось обновить карту!']);
        }

        return response()->json(['success' => 'Карта успешно обновлена!']);

    }

    public function mapDelete(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $query = ProjectApartmentMap::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить карту!']);
        }

        return response()->json(['success' => 'Карта успешно удалёна!', 'component' => 'video']);
    }
}
