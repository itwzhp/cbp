<?php
namespace App\Domains\Reviews;

use App\Domains\Materials\Models\Material;
use App\Domains\Reviews\Events\ReviewStartedEvent;
use App\Domains\Reviews\Models\Review;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RoleHelper;

class ReviewsRepository
{
    public function startReview(Material $material, User $user): Review
    {
        if ($user->cannot(RoleHelper::MATERIAL_REVIEW)) {
            throw new UnauthorizedException('This user cannot make reviews');
        }

        $review = Review::firstOrCreate([
            'material_id' => $material->id,
            'user_id'     => $user->id,
        ]);

        event(new ReviewStartedEvent($review));

        return $review;
    }
}
