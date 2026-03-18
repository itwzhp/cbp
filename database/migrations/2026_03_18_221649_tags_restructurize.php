<?php

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tax = Taxonomy::where('slug', 'zorganizowanie-programu-harcerskiego')->first();
        if ($tax !== null) {
            $tax->update(['slug' => 'plan-pracy']);
        }

        $tax = Taxonomy::where('slug', 'plan-pracy')->first();
        $slugs = [
            'planowanie-w-druzynie',
            'oboz',
        ];

        $tags = Tag::findBySlugs($slugs)->update([
            'taxonomy_id' => $tax->id,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tax = Taxonomy::where('slug', 'plan-pracy')->first();
        $tax->update(['slug' => 'zorganizowanie-programu-harcerskiego']);

        $tax = Taxonomy::where('slug', 'harcerski-system-wychowawczy')->first();
        $slugs = [
            'planowanie-w-druzynie',
            'oboz',
        ];

        $tags = Tag::findBySlugs($slugs)->update([
            'taxonomy_id' => $tax->id,
        ]);
    }
};
