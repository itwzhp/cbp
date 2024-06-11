<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Materials\Models\Enums\PresetEnum;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Repositories\MaterialsRepository;
use App\Domains\Materials\States\Archived;
use App\Domains\Materials\States\Draft;
use App\Domains\Materials\States\MaterialState;
use App\Domains\Materials\States\Published;
use App\Domains\Reviews\Models\Review;
use App\Domains\Users\Roles\FrontendPermissionsAccessor;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MaterialsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render(ComponentsHelper::ADMIN_MATERIALS_INDEX);
    }

    public function edit(Material $material): Response
    {
        $material->load('fields', 'attachments', 'licence', 'setups', 'scenarios', 'tags');

        return Inertia::render(ComponentsHelper::ADMIN_MATERIALS_EDIT)
            ->with([
                'material'    => $material,
                'token'       => csrf_token(),
                'permissions' => (new FrontendPermissionsAccessor(Auth::user()))->actionsOn($material),
            ]);
    }

    public function create(): Response
    {
        return Inertia::render(ComponentsHelper::ADMIN_MATERIALS_CREATE)->with([
            'presets' => PresetEnum::options(),
        ]);
    }

    public function new(PresetEnum $preset, MaterialsRepository $repository): RedirectResponse
    {
        $material = $repository->createWithPreset(Auth::user(), $preset);

        return Redirect::route('admin.materials.edit', $material);
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return back();
    }

    public function changeStatus(Material $material, string $status)
    {
        if (Auth::user()->cannot('manage', $material)) {
            abort(403);
        }

        match ($status) {
            default => null,
            'draft'  =>  $material->isDraft() ? null : $material->state->transitionTo(Draft::class),
            'published' =>  $material->isPublished() ? null : $material->state->transitionTo(Published::class),
            'archived' =>  $material->isArchived() ? null : $material->state->transitionTo(Archived::class),
        };

        return back();
    }
}
