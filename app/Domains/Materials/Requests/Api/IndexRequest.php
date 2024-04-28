<?php
namespace App\Domains\Materials\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page'   => 'numeric|nullable',
            'search' => 'nullable|string|min:3',
            'tags'   => 'nullable|array',
            'tags.*' => 'numeric',
        ];
    }

    public function hasSearch(): bool
    {
        return !empty($this->input('search'));
    }

    public function wantsJson()
    {
        return true;
    }
}
