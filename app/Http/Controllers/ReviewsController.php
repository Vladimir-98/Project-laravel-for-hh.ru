<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\ReviewRequest;
use App\Models\Admin\Review;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ReviewsController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */

    public function index(Request $request): Factory|View|Application
    {
        $validated = $request->validate([
            'review_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $quantity = $request->get('quantity');
        $quantity += 10;
        $review_id = $request->get('review_id');
        $reviews = Review::where('review_gable_id', $review_id)
            ->where('review_gable_type', 'App\Models\Admin\Project')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->limit($quantity)
            ->get();

        $quantity >= count($reviews) ? $reviews_length = false : $reviews_length = true;

        return view('layouts.reviews', compact([
            'reviews',
            'quantity',
            'reviews_length',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     * @param ReviewRequest $request
     * @return JsonResponse
     */

    public function create(ReviewRequest $request): JsonResponse
    {
        if (!Auth::user()) {
            return response()->json();
        }

        if ( $request->get('review_type') == 'Project' ) {
            $review_type = 'App\Models\Admin\Project';
        } elseif( $request->get('review_type') == 'Page' ) {
            $review_type = 'App\Models\Admin\Page';
        }

        $review_id = $request->get('review_id');
        $reviews = Review::where('user_id', auth()->id())
            ->where('review_gable_id', $review_id)
            ->where('review_gable_type', $review_type)
            ->get();
        if ($reviews && count($reviews) > 3) {
            return response()->json(['success' => Lang::get('main.review_success')]);
        }

        $query = Review::create([
            'review' => strip_tags($request->get('review'), '<br>'),
            'review_gable_id' => $review_id,
            'review_gable_type' => $review_type,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['success' => Lang::get('main.review_success')]);

    }
}
