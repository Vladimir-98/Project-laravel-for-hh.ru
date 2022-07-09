<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProjectApartmentVideo;
use App\Models\Admin\Apartments;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ApartmentVideoController extends Controller
{
    const PATH = 'admin.apartments.components.';

    /**
     * @param $id
     * @return string
     */

    public function video($id): string
    {

        $apartment = Apartments::find($id);

        if ( !$apartment ) { abort(404); }

        return view(self::PATH . 'video', compact([
            'apartment'
        ]))->render();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function videoUpdate(Request $request): JsonResponse
    {

        $video_id = $request->get('video_gable_id');
        $video_type = $request->get('video_gable_type');
        $video_table = $request->all();

        $video = ProjectApartmentVideo::where('video_gable_id', $video_id)->where('video_gable_type', $video_type)->first();

        if ($video !== null) {

            $query = $video->fill($video_table)->update();

        } else {
            $query = ProjectApartmentVideo::create($video_table);
        }

        if (!$query) {
            return response()->json(['Не удалось обновить видео!']);
        }

        return response()->json(['success' => 'Видео успешно обновлена!']);

    }

    public function videoDelete(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $query = ProjectApartmentVideo::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить видео!']);
        }

        return response()->json(['success' => 'Видео успешно удалёна!', 'component' => 'video']);
    }
}
