<?php
namespace App\Domains\Materials;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method-static self search(string $string)
 */
class MaterialSearcher
{
    const MODE_OR = 'or';
    const MODE_AND = 'and';
    const MODE_ANDOR = 'andor';

    protected string $search;

    protected Collection $tags;

    protected string $mode = self::MODE_OR;

    public static function make(): self
    {
        return new MaterialSearcher();
    }

    public function search(string $string): self
    {
        $this->search = $string;

        return $this;
    }

    public function withTags(array $tags): self
    {
        $this->tags = Tag::whereIn('id', $tags)
            ->with('taxonomy')
            ->get();

        return $this;
    }

    public function inAndMode(): self
    {
        return $this->setMode(static::MODE_AND);
    }

    public function inOrMode(): self
    {
        return $this->setMode(static::MODE_OR);
    }

    public function inAndOrMode(): self
    {
        return $this->setMode(static::MODE_ANDOR);
    }

    public function setMode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return (new self())->$name($arguments);
    }

    public function query(): Builder
    {
        $query = Material::query();

        if (!empty($this->search)) {
            $query = $query->search($this->search);
        }

        if (count($this->tags) === 0) {
            return $query;
        }

        if (empty($this->mode)) {
            $this->mode = static::MODE_OR;
        }

        if ($this->isOrMode()) {
            return $this->addOrClause($query, $this->tags);
        }

        if ($this->isAndMode()) {
            return $this->addAndClause($query, $this->tags);
        }

        $tagsGrouped = $this->tags->groupBy('taxonomy_id');

        foreach ($tagsGrouped as $group) {
            $query = $this->addOrClause($query, $group);
        }

        return $query;
    }

    protected function isOrMode(): bool
    {
        return $this->mode === static::MODE_OR;
    }

    protected function isAndMode(): bool
    {
        return $this->mode === static::MODE_AND;
    }

    protected function isAndOrMode(): bool
    {
        return $this->mode === static::MODE_ANDOR;
    }

    protected function addOrClause(Builder $query, Collection $tags): Builder
    {
        return $query->where(function (Builder $q) use ($tags) {
            /** @var Tag $tag */
            foreach ($tags as $tag) {
                $q->orWhereHas('tags', function (Builder $tq) use ($tag) {
                    $tq->where('id', $tag->id);
                });
            }
        });
    }

    protected function addAndClause(Builder $query, Collection $tags): Builder
    {
        return $query->where(function (Builder $q) use ($tags) {
            /** @var Tag $tag */
            foreach ($tags as $tag) {
                $q->whereHas('tags', function (Builder $tq) use ($tag) {
                    $tq->where('id', $tag->id);
                });
            }
        });
    }
}
