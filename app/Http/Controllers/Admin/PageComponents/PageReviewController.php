<?php

namespace App\Http\Controllers\Admin\PageComponents;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageReview\PageReviewRequest;
use App\Models\Admin\Page;
use App\Models\Admin\PageReview;
use Illuminate\Http\JsonResponse;

class PageReviewController extends Controller
{
    const PATH = 'admin.pages.';

    /**
     * @param $id
     * @return string
     */

    public function review($id): string
    {
        $page = Page::find($id);

        if ( !$page ) { abort(404); }

        return view(self::PATH . 'review', compact([
            'page'
        ]))->render();

    }

    /**
     * @param PageReviewRequest $request
     * @return JsonResponse
     */

    public function reviewUpdate(PageReviewRequest $request): JsonResponse
    {

        $page_id = $request->get('review_gable_id');
        $page_type = $request->get('review_gable_type');
        $review_table = $request->all();

        /** Обновление изображений */
        $review = PageReview::where('review_gable_id', $page_id)->where('review_gable_type', $page_type)->first();

        if ($review) {

            $query = $review->fill($review_table)->update();

        } else {

            $query = PageReview::create($review_table);
        }

        $error = 'Не удалось обновить блок отзывов!';
        $success = 'Блок отзывов успешно обновлён!';

        if ( $page_id == 8 ) {
            $error = 'Не удалось обновить информацию!';
            $success = 'Информация успешно обновлено!';
        } elseif ( $page_id == 9 ) {
            $error = 'Не удалось обновить описание!';
            $success = 'Описание успешно обновлено!';
        }
        if (!$query) {
            return response()->json([$error]);
        }

        return response()->json(['success' => $success]);

    }

}
