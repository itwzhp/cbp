<?php
namespace App\Domains\Files\Controllers;

use App\Domains\Files\Models\Attachment;
use App\Http\Controllers\Controller;

class DownloadAttachmentController extends Controller
{
    public function __invoke(Attachment $attachment)
    {
        $attachment->incrementDownloads();

        return redirect($attachment->url());
    }
}
