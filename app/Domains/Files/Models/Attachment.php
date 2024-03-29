<?php
namespace App\Domains\Files\Models;

use App\Domains\Files\Enums\PrintColorEnum;
use App\Domains\Files\Enums\SizeEnum;
use App\Domains\Files\Enums\ThicknessEnum;
use App\Domains\Files\Models\Factories\AttachmentFactory;
use App\Domains\Materials\Models\Traits\BelongsToMaterial;
use App\Helpers\FilesystemsHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int         id
 * @property string      name
 * @property int|null    wp_id
 * @property string      path
 * @property string      disk
 * @property string      mime
 * @property int         downloads
 * @property string|null element
 * @property int|null    copies
 * @property string|null print_color
 * @property string|null thickness
 * @property string|null size
 * @property string|null comment
 * @property string|null paper_color
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property-read string download_url
 * @property-read
 */
class Attachment extends Model
{
    use BelongsToMaterial;
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'size'        => SizeEnum::class,
        'print_color' => PrintColorEnum::class,
        'thickness'   => ThicknessEnum::class,
    ];

    protected $appends = [
        'download_url',
    ];

    protected static function newFactory(): AttachmentFactory
    {
        return AttachmentFactory::new();
    }

    public function url(): string
    {
        return FilesystemsHelper::getDisk($this->disk)->url($this->path);
    }

    public static function fromPath(string $path, string $disk = 'local'): ?self
    {
        if ($attachment = Attachment::where('path', $path)->first()) {
            return $attachment;
        }

        if (!Storage::disk($disk)->exists($path)) {
            return null;
        }

        $attachment = new self();
        $attachment->fill([
            'name' => basename($path),
            'path' => $path,
            'mime' => Storage::disk($disk)->mimeType($path),
        ]);

        return $attachment;
    }

    public function getContents(): string
    {
        return FilesystemsHelper::getDisk($this->disk)->get($this->path);
    }

    public function downloadUrl(): string
    {
        return route('attachments.download', $this);
    }

    public function getDownloadUrlAttribute(): string
    {
        return $this->url();
    }

    public function incrementDownloads(): self
    {
        $this->update([
            'downloads' => $this->downloads + 1,
        ]);

        return $this;
    }

    public function disk(): Filesystem
    {
        return FilesystemsHelper::getDisk($this->disk);
    }
}
