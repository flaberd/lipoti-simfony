<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lipoti\Shop\Common\Entity\Traits\IdentifiableEntityTrait;
use Lipoti\Shop\Common\Entity\Traits\TimestampableEntityTrait;

/**
 * @ORM\Entity
 */
class Category
{
    use IdentifiableEntityTrait;
    use TimestampableEntityTrait;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private int $status = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Lipoti\Shop\Core\Entity\Category")
     */
    private ?Category $parent = null;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): void
    {
        $this->parent = $parent;
    }
}
