<?php
namespace App\Domains\Materials\Models\Observers;

use App\Domains\Materials\Models\Taxonomy;

class TaxonomyObserver
{
    public function deleted(Taxonomy $taxonomy)
    {
        $taxonomy->tags()->delete();
    }
}
