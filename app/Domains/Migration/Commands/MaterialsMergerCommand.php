<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\States\Archived;
use Illuminate\Console\Command;

class MaterialsMergerCommand extends Command
{
    protected $signature = 'wp:merge';

    const TO_MERGE = [
        4411 => [
            4245,
            2771,
            2812,
            1412,
            2576,
            4201,
            1780,
            4214,
            2722,
            1503,
            2104,
            1624,
            1559,
            1610,
            2344,
            2085,
            3768,
            2006,
            1577,
            2443,
            1984,
            2119,
            4235,
            2403,
            3898,
            2026,
            2055,
            1828,
            1653,
            1638,
            1495,
            2746,
            2846,
            4263,
            1800,
            4284,
            2139,
            2431,
            1937,
            2189,
            1462,
            1854,
            4300,
            2466,
            4133,
        ],
        4425 => [
            4034,
            4032,
            4037,
        ],
    ];

    public function __invoke()
    {
        foreach (self::TO_MERGE as $parent => $ids) {
            $this->merge($parent, $ids);
        }
    }

    private function merge(int $parentId, array $ids)
    {
        $parent = Material::findByWp($parentId);
        $this->info('Merging into: ' . $parent->title);

        $submaterials = Material::whereIn('wp_id', $ids)->with('attachments')->get();
        Attachment::whereIn('material_id', $submaterials->pluck('id'))
            ->update([
                'material_id' => $parent->id,
            ]);

        Material::whereIn('id', $submaterials->pluck('id'))->update([
            'state' => Archived::class,
        ]);
    }
}
