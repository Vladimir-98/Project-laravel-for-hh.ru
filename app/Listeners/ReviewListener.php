<?php

namespace App\Listeners;

use App\Events\ReviewEvent;
use App\Models\Admin\Review;

class ReviewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ReviewEvent $event
     * @return void
     */
    public function handle(ReviewEvent $event)
    {
        $new_review = Review::where('status', null)->get();
        count($new_review) == 0 && session()->has('count.reviews') ? session()->forget('count.reviews') : session()->put('count.reviews', count($new_review));
    }
}
