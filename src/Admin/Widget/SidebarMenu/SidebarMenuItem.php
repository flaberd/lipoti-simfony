<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Widget\SidebarMenu;

class SidebarMenuItem
{
    private string $name;

    private ?string $path = null;

    private ?string $icon = null;

    private bool $active;

    private ?array $children = null;

    private ?array $indicatorPath = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getChildren(): ?array
    {
        return $this->children;
    }

    public function setChildren(?array $children): void
    {
        $this->children = $children;
    }

    public function getIndicatorPath(): ?array
    {
        return $this->indicatorPath;
    }

    public function setIndicatorPath(?array $indicatorPath): void
    {
        $this->indicatorPath = $indicatorPath;
    }
}
