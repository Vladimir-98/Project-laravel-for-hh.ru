<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdateReviewEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin\Review;
use App\Models\Admin\ReviewAnswer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    const PATH = 'admin.reviews.';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index()
    {
        $sort_id = 'desc';
        $page = '1';
        $reviews = Review::orderBy('id', $sort_id)->paginate(10);

        return view(self::PATH . 'index', compact([
                'reviews',
                'sort_id',
                'page',
            ]
        ));
    }

    public function table(Request $request): string
    {
        $sort_id = $request->get('sort_id');

        $page = $request->get('page');

        $reviews = Review::orderBy('id', $sort_id)->paginate(10);

        return view(self::PATH . 'table', compact([
            'reviews',
            'sort_id',
            'page'
        ]))->render();
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

        event(new UpdateReviewEvent($id));

        $notification = session()->get('count.reviews');

        $review = Review::find($id);

        return view(self::PATH . 'modal', compact([
            'review',
            'delete',
            'notification'
        ]))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function update(Request $request): JsonResponse
    {
        $id = $request->get('id');
        $review['review'] = $request->get('review');
        $review['user_id'] = $request->get('user_id');
        $query = Review::find($id)->fill($review)->update();

        $answer['answer'] = $request->get('answer');
        $answer['review_id'] = $id;
        $answer['user_id'] = auth()->id();

        if ($request->get('answer_id')) {
            $query = ReviewAnswer::find($request->get('answer_id'))->fill($answer)->update();
        } else {
            $query = ReviewAnswer::create($answer);
        }

        if (!$query) {
            return response()->json(['Не удалось обновить отзыв!']);
        }

        return response()->json(['success' => 'Отзыв ' . $request->get('review_delete') . ' успешно обновлен!']);
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

        if ($answer = ReviewAnswer::where('review_id', $id)->first()) {
            ReviewAnswer::destroy($answer->id);
        }

        $query = Review::destroy($id);

        if (!$query) {
            return response()->json(['Не удалось удалить отзыв!']);
        }
        return response()->json(['success' => 'Отзыв ' . $request->get('review_delete') . ' успешно удалён!']);
    }
}
