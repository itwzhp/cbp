<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Admin\Requests\AuthorizesMaterialElementUpdateTrait;
use App\Domains\Materials\Models\Setup;
use Illuminate\Foundation\Http\FormRequest;

class DestroyScenarioRequest extends FormRequest
{
    use AuthorizesMaterialElementUpdateTrait;

    public function authorize(): bool
    {
        /** @var Setup $scenario */
        $scenario = $this->route('scenario');

        return $this->authorizeUpdate($scenario);
    }

    public function rules(): array
    {
        return [];
    }
}
