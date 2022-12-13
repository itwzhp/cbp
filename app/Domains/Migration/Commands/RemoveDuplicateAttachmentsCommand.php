<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Files\Models\Attachment;
use Illuminate\Console\Command;

class RemoveDuplicateAttachmentsCommand extends Command
{
    const PROPERTIES = [
        'wp_id',
        'element',
        'copies',
        'print_color',
        'thickness',
        'size',
        'comment',
        'paper_color',
    ];

    protected $signature = 'wp:duplicates';

    public function __invoke()
    {
        /** @var Attachment $attachment */
        foreach (Attachment::orderBy('id')->get() as $attachment) {
            $duplicate = Attachment::where('path', $attachment->path)
                ->where('id', '>', $attachment->id)
                ->first();

            if ($duplicate !== null) {
                $this->clearDuplicates($attachment, $duplicate);
            }
        }
    }

    private function clearDuplicates(Attachment $attachment, Attachment $duplicate)
    {
        if ($this->countScore($attachment) > $this->countScore($duplicate)) {
            $duplicate->delete();
        } else {
            $attachment->delete();
        }
    }

    private function countScore(Attachment $attachment): int
    {
        $score = 0;

        foreach (static::PROPERTIES as $PROPERTY) {
            if (!empty($attachment->$PROPERTY)) {
                $score++;
            }
        }

        return $score;
    }
}
