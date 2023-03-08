<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Admin\Requests\Api\UpdateAttachmentRequest;
use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use App\Http\Controllers\AbstractAdminController;

class AttachmentsController extends AbstractAdminController
{
    public function destroy(Material $material, Attachment $attachment)
    {
        $this->authorize(MaterialActionsEnum::UPDATE->value, $material);
        $attachment->delete();

        return $this->responseOK();
    }

    public function download(Material $material, Attachment $attachment)
    {
        $this->authorize(MaterialActionsEnum::VIEW->value, $material);

        return $attachment->disk()->download($attachment->path);
    }

    public function update(Material $material, Attachment $attachment, UpdateAttachmentRequest $request)
    {
        $attachment->update($request->validated());

        return $this->responseOK();
    }
}
