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
        return Material::query();
    }
}
