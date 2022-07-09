<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageTitle\PageTitleRequest;
use App\Models\Admin\Page;
use App\Models\Admin\PageTitle;
use Illuminate\Http\JsonResponse;


class PageTitleController extends Controller
{
    const PATH = 'admin.pages.';

    /**
     * @param $id
     * @return string
     */

    public function pageTitle($id): string
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'title', compact([
            'page'
        ]))->render();

    }

    /**
     * @param PageTitleRequest $request
     * @return JsonResponse
     */

    public function pageTitleUpdate(PageTitleRequest $request): JsonResponse
    {

        $page_id = $request->get('page_title_gable_id');
        $page_type = $request->get('page_title_gable_type');
        $page_title_table = $request->all();

        /** Обновление заголовков */
        $page_titles = PageTitle::where('page_title_gable_id', $page_id)->where('page_title_gable_type', $page_type)->first();

        if ($page_titles !== null) {

            $query = $page_titles->fill($page_title_table)->update();

        } else {

            $query = PageTitle::create($page_title_table);
        }


        if (!$query) {
            return response()->json(['Не удалось обновить заголовки!']);
        }

        return response()->json(['success' => 'Заголовки успешно обновлены!']);

    }
}
