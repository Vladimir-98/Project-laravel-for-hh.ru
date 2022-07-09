<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meta\MetaRequest;
use App\Models\Admin\Meta;
use App\Models\Admin\Page;
use Illuminate\Http\JsonResponse;


class MetaController extends Controller
{
    const PATH = 'admin.pages.';

    /**
     * @param $id
     * @return string
     */

    public function meta($id): string
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'meta', compact([
            'page'
        ]))->render();

    }

    /**
     * @param MetaRequest $request
     * @return JsonResponse
     */

    public function metaUpdate(MetaRequest $request): JsonResponse
    {

        $page_id = $request->get('meta_gable_id');
        $page_type = $request->get('meta_gable_type');
        $meta_table = $request->all();

        $meta = Meta::where('meta_gable_id', $page_id)->where('meta_gable_type', $page_type)->first();

        if ($meta !== null) {

            $query = $meta->fill($meta_table)->update();

        } else {
            $query = Meta::create($meta_table);
        }


        if (!$query) {
            return response()->json(['Не удалось обновить мета теги!']);
        }

        return response()->json(['success' => 'Мета теги успешно обновлены!']);

    }
}
