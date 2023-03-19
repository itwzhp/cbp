<?php
namespace App\Domains\Visuals\Menu;

class MenuLink
{
    protected string $route;

    protected array $params;

    public function __construct(string $route, array $params = [])
    {
        $this->route = $route;
        $this->params = $params;
    }

    public function __toString(): string
    {
        return route($this->route, $this->params);
    }
}
