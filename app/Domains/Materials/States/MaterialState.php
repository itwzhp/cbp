<?php
namespace App\Domains\Materials\States;

use Illuminate\Support\Arr;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class MaterialState extends State
{
    const NAMES = [
        Draft::class            => 'draft',
        InReview::class         => 'review',
        ChangesRequested::class => 'changes',
        Pending::class          => 'pending',
        Published::class        => 'published',
        Rejected::class         => 'rejected',
        Archived::class         => 'archived',
    ];

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
            ->allowTransition(Published::class, Draft::class)
            ->allowTransition(Published::class, Archived::class)
            ->allowTransition(Archived::class, Draft::class)
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

    public function toSimplifiedString(): string
    {
        return Arr::get(static::NAMES, $this->getValue(), '');
    }

    public static function getStatesValidationRule(): string
    {
        return 'in:' . implode(',', array_values(static::NAMES));
    }
}
