<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Http\Controllers\AbstractAdminController;
use Illuminate\Support\Facades\Auth;

class AttachmentsController extends AbstractAdminController
{
    public function destroy(Material $material, Attachment $attachment)
    {
        $this->authorize(MaterialActionsEnum::UPDATE->value, $material);
//        if (Auth::user()->cannot(MaterialActionsEnum::UPDATE->value, $material)) {
//            throw new UnauthorizedException();
//        }

        $attachment->delete();

        return $this->responseOK();
    }
}
