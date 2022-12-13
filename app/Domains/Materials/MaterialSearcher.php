<?php
namespace App\Domains\Materials;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MaterialSearcher
{
    public const MODE_OR = 'or';
    public const MODE_AND = 'and';
    public const MODE_ANDOR = 'andor';
    public const SQL_SUBQUERY = <<<'EOL'
(exists(
        select *
        from material_tag
        where material_id = materials.id
          and (?)
    ))
EOL;

    protected ?string $search;

    protected Collection $tags;

    protected string $mode = self::MODE_OR;

    public static function make(): self
    {
        return new MaterialSearcher();
    }

    public function search(?string $string): self
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
            return $this->addSubquery($query, $this->tags, 'or');
        }

        if ($this->isAndMode()) {
            return $this->addSubquery($query, $this->tags, 'and');
        }

        $tagsGrouped = $this->tags->groupBy('taxonomy_id');

        foreach ($tagsGrouped as $group) {
            $query = $this->addSubquery($query, $group, 'or');
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

    protected function addSubquery(Builder $query, Collection $tags, string $operator = 'or'): Builder
    {
        if (!in_array(trim(strtolower($operator)), ['and', 'or'])) {
            throw new \InvalidArgumentException('Wrong operator');
        }

        $tagsOrString = $tags->map(function (Tag $tag) {
            return 'tag_id = ' . $tag->id;
        })->implode(" {$operator} ");

        return $query->whereRaw(str_replace('?', $tagsOrString, static::SQL_SUBQUERY));
    }
}
