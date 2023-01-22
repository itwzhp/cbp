<?php
namespace App\Domains\Materials\States;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Exceptions\UnauthorizedException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\ModelStates\Transition;

class AnyToPublishedTransition extends Transition
{
    protected Material $material;

    protected string $message;

    public function __construct(Material $material, string $message)
    {
        $this->material = $material;
        $this->message = $message;
    }

    public function handle(): Material
    {
        if (!Auth::user()->can('publish materials')) {
            throw new UnauthorizedException('You cannot do this');
        }

        if ($this->material->published_at === null) {
            $this->material->published_at = Carbon::now();
        }
        $this->material->state = Published::class;
        $this->material->save();

        return $this->material;
    }
}
