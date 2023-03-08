<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Files\Enums\PrintColorEnum;
use App\Domains\Files\Enums\SizeEnum;
use App\Domains\Files\Enums\ThicknessEnum;
use App\Domains\Files\Models\Attachment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var Attachment $attachment */
        $attachment = $this->route('attachment');

        return Auth::user()->can(MaterialActionsEnum::UPDATE->value, $attachment->material);
    }

    public function rules(): array
    {
        return [
            'element'     => [
                'nullable',
                'string',
            ],
            'copies'      => ['nullable', 'integer'],
            'print_color' => [
                'nullable',
                'string',
                PrintColorEnum::rules(),
            ],
            'thickness'   => [
                'nullable',
                'string',
                ThicknessEnum::rules(),
            ],
            'size'        => [
                'nullable',
                'string',
                SizeEnum::rules(),
            ],
            'comment'     => [
                'nullable',
                'string',
            ],
            'paper_color' => [
                'nullable',
                'string',
            ],
        ];
    }
}
