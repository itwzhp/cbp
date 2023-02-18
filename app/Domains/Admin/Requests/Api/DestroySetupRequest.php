<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Setup;
use Illuminate\Foundation\Http\FormRequest;

class DestroySetupRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var Material $material */
        $material = $this->route('material');
        /** @var Setup $setup */
        $setup = $this->route('setup');

        return $material->id === $setup->material_id;
    }

    public function rules(): array
    {
        return [];
    }
}
