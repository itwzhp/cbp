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
            ->allowTransition(Draft::class, Rejected::class)
            ->allowTransition(Pending::class, InReview::class)
            ->allowTransition(InReview::class, Published::class)
            ->allowTransition(InReview::class, ChangesRequested::class)
            ->allowTransition(InReview::class, Rejected::class)
            ->allowTransition(ChangesRequested::class, Pending::class);
    }
}
