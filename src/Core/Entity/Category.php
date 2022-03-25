<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Lipoti\Shop\Common\Entity\Traits\IdentifiableEntityTrait;
use Lipoti\Shop\Common\Entity\Traits\TimestampableEntityTrait;

/**
 * @ORM\Entity(repositoryClass="Lipoti\Shop\Core\Repository\CategoryRepository")
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

    /**
     * @ORM\OneToMany(targetEntity=CategoryLang::class, mappedBy="category")
     */
    private Collection $lang;

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

    public function getLang(): Collection
    {
        return $this->lang;
    }

    public function getLangByLocale(string $locale): ?CategoryLang
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('lang', $locale));

        return $this->lang->matching($criteria)[0] ?? null;
    }
}
