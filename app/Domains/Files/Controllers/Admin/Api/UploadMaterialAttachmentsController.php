<?php
namespace App\Domains\Files\Controllers\Admin\Api;

use App\Http\Controllers\AbstractAdminController;

class UploadMaterialAttachmentsController extends AbstractAdminController
{
    public function upload()
    {
        dd(request()->all());
    }
}
