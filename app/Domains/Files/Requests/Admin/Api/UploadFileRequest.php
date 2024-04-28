<?php
namespace App\Domains\Files\Requests\Admin\Api;

use App\Domains\Admin\MaterialActionsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()
            ->can(
                MaterialActionsEnum::UPDATE->value,
                $this->route('material')
            );
    }

    public function rules(): array
    {
        return [
            'attachments' => 'required|file',
        ];
    }
}
