<?php
namespace App\Domains\Migration\Operators;

use App\Domains\Files\Enums\PrintColorEnum;
use App\Domains\Files\Enums\SizeEnum;
use App\Domains\Files\Enums\ThicknessEnum;
use App\Domains\Files\Models\Attachment;
use App\Domains\Migration\Models\Post;
use App\Helpers\FilesystemsHelper;
use Illuminate\Support\Str;

class Zalacznik
{
    protected Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPath(): string
    {
        return Str::replace(
            ['http://cbp.zhp.pl/wp-content/uploads/', 'https://cbp.zhp.pl/wp-content/uploads/'],
            '',
            $this->post->getPostmetas('wpcf-zalacznik')->value('meta_value')
        );
    }

    public function toAttachment(): Attachment
    {
        $attachment = Attachment::fromPath($this->getPath(), FilesystemsHelper::PUBLIC);

        if ($attachment === null) {
            throw new \InvalidArgumentException($this->getPath());
        }

        $attachment->fill([
            'name'        => $this->post->post_title,
            'element'     => substr($this->post->getPostmetas('wpcf-element')?->value('meta_value'), 0, 254),
            'copies'      => $this->post->getPostmetas('wpcf-liczba-kopii')?->value('meta_value'),
            'print_color' => PrintColorEnum::fromWp(
                $this->post->getPostmetas('wpcf-kolor-wydruku')?->value('meta_value')
            ),
            'thickness'   => ThicknessEnum::fromWp(
                $this->post->getPostmetas('wpcf-grubosc')?->value('meta_value')
            ),
            'size'        => SizeEnum::fromWp(
                $this->post->getPostmetas('wpcf-wielkosc-kartki')?->value('meta_value')
            ),
            'comment'     => $this->post->getPostmetas('wpcf-zalacznik-uwagi')?->value('meta_value'),
            'paper_color' => $this->post->getPostmetas('wpcf-kolor-kartki2')?->value('meta_value'),
        ]);

        return $attachment;
    }
}
