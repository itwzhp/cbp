<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use App\Http\Controllers\AbstractAdminController;

class AttachmentsController extends AbstractAdminController
{
    public function destroy(Material $material, Attachment $attachment)
    {
        $this->authorize(MaterialActionsEnum::UPDATE, $material);
        $attachment->delete();

        return $this->responseOK();
    }
}
