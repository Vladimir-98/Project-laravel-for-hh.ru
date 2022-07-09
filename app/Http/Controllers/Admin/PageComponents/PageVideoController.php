<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Admin\PageVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PageVideoController extends Controller
{
    const PATH = 'admin.pages.';

    /**
     * @param $id
     * @return string
     */

    public function video($id): string
    {

        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'video', compact([
            'page'
        ]))->render();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function videoUpdate(Request $request): JsonResponse
    {
        $page_id = $request->get('page_id');

        $video_table = $request->all();

        $video = PageVideo::where('page_id', $page_id)->first();

        if ($video !== null) {

            $query = $video->fill($video_table)->update();

        } else {
            $query = PageVideo::create($video_table);
        }

        if (!$query) {
            return response()->json(['Не удалось обновить видео!']);
        }

        return response()->json(['success' => 'Видео успешно обновлено!']);

    }


    public function videoDelete(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $query = PageVideo::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить видео!']);
        }

        return response()->json(['success' => 'Видео успешно удалёна!', 'component' => 'video']);
    }
}
