<?php
namespace App\Domains\Materials\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class MaterialState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Draft::class)
            ->allowTransition(Draft::class, Pending::class)
            ->allowTransition([
                Draft::class,
                InReview::class,
            ], Published::class, AnyToPublishedTransition::class)
            ->allowTransition(InReview::class, ChangesRequested::class)
            ->allowTransition([
                InReview::class,
                Draft::class,
                ChangesRequested::class,
            ], Rejected::class)
            ->allowTransition([
                Pending::class,
                ChangesRequested::class,
            ], InReview::class)
            ->allowTransition([
                Draft::class,
                Pending::class,
                InReview::class,
                Published::class,
                ChangesRequested::class,
                Rejected::class,
                Archived::class,
            ], Archived::class);
    }

    public function __toString(): string
    {
        return match ($this->getValue()) {
            Draft::class            => 'draft',
            InReview::class         => 'review',
            ChangesRequested::class => 'changes',
            Pending::class          => 'pending',
            Published::class        => 'published',
            Rejected::class         => 'rejected',
            Archived::class         => 'archived',
        };
    }
}
