<?php
namespace App\Domains\Files\Models;

use App\Domains\Files\Enums\PrintColorEnum;
use App\Domains\Files\Enums\SizeEnum;
use App\Domains\Files\Enums\ThicknessEnum;
use App\Domains\Materials\Models\Material;
use App\Helpers\FilesystemsHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int           id
 * @property string        name
 * @property int           material_id
 * @property int|null      wp_id
 * @property string        path
 * @property string        mime
 * @property int           downloads
 * @property string|null   element
 * @property int|null      copies
 * @property string|null   print_color
 * @property string|null   thickness
 * @property string|null   size
 * @property string|null   comment
 * @property string|null   paper_color
 * @property Carbon        created_at
 * @property Carbon        updated_at
 * @property-read Material material
 */
class Attachment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'size'        => SizeEnum::class,
        'print_color' => PrintColorEnum::class,
        'thickness'   => ThicknessEnum::class,
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function url(): string
    {
        return FilesystemsHelper::getPublic()->url($this->path);
    }

    public static function fromPath(string $path): ?self
    {
        if ($attachment = Attachment::where('path', $path)->first()) {
            return $attachment;
        }

        if (!Storage::exists($path)) {
            return null;
        }

        $attachment = new self();
        $attachment->fill([
            'name' => basename($path),
            'path' => $path,
            'mime' => Storage::mimeType($path),
        ]);

        return $attachment;
    }

    public function getContents(): string
    {
        return FilesystemsHelper::getPublic()->get($this->path);
    }
}
