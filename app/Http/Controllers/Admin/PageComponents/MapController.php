<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Map\MapRequest;
use App\Models\Admin\Map;
use App\Models\Admin\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class MapController extends Controller
{
    const PATH = 'admin.pages.';

    /**
     * @param $id
     * @return string
     */

    public function map($id): string
    {
        $page = Page::find($id);

        if (!$page) {
            abort(404);
        }

        return view(self::PATH . 'map', compact([
            'page'
        ]))->render();

    }

    /**
     * @param MapRequest $request
     * @return JsonResponse
     */

    public function mapUpdate(MapRequest $request): JsonResponse
    {

        $page_id = $request->get('map_gable_id');
        $page_type = $request->get('map_gable_type');
        $map_table = $request->all();

        $map = Map::where('map_gable_id', $page_id)->where('map_gable_type', $page_type)->first();

        if ($map !== null) {

            $query = $map->fill($map_table)->update();

        } else {
            $query = Map::create($map_table);
        }


        if (!$query) {
            return response()->json(['Не удалось обновить карту!']);
        }

        return response()->json(['success' => 'Карта успешно обновлена!']);

    }

    public function mapDelete(Request $request)
    {
        $id = $request->get('id');

        $query = Map::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить карту!']);
        }

        return response()->json(['success' => 'Карта успешно удалёна!', 'component' => 'map']);
    }
}
