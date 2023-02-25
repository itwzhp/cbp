<?php
namespace App\Domains\Files\Controllers\Admin\Api;

use App\Domains\Files\AttachmentsRepository;
use App\Domains\Files\Requests\Admin\Api\UploadFileRequest;
use App\Domains\Materials\Models\Material;
use App\Http\Controllers\AbstractAdminController;

class UploadMaterialAttachmentsController extends AbstractAdminController
{
    public function upload(Material $material, UploadFileRequest $request, AttachmentsRepository $repository)
    {
        $file = $request->file('attachments');

        $attachment = $repository->fromFileUpload($material, $file);

        return [
            'ext'        => $file->getClientOriginalExtension(),
            'name'       => $file->getClientOriginalName(),
            'mime'       => $file->getMimeType(),
            'attachment' => $attachment->toArray(),
        ];
    }
}
