<?php
namespace App\Domains\Admin\Requests;

use App\Domains\Materials\Models\Taxonomy;

class StoreTagRequest extends UpdateTagRequest
{
    public function rules(): array
    {
        return parent::rules()
            + [
                'taxonomy_id' => 'required|int|exists:taxonomies,id',
            ];
    }

    public function taxonomy(): Taxonomy
    {
        return Taxonomy::find($this->input('taxonomy_id'));
    }
}
