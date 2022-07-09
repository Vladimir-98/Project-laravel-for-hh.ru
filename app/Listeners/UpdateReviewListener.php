<?php

namespace App\Listeners;

use App\Events\ReviewEvent;
use App\Events\UpdateReviewEvent;
use App\Models\Admin\Review;

class UpdateReviewListener
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param UpdateReviewEvent $event
     * @return void
     */
    public function handle(UpdateReviewEvent $event)
    {
        $id = $event->id;
        $review = Review::find($id);
        if ($review['status'] === null) {
            $review['status'] = 1;
            $review->save();
            session()->forget('count.reviews');
            event(new ReviewEvent());
        }
    }
}
