<?php
namespace App\Domains\Reviews\Events;

use App\Abstracts\AbstractEvent;
use App\Domains\Reviews\Models\Review;

class ReviewStartedEvent extends AbstractEvent
{
    protected Review $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}
