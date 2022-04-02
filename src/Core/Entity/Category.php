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
    private Collection $translation;

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

    public function getTranslation(): Collection
    {
        return $this->translation;
    }

    public function getTranslationByLocale(string $locale): ?CategoryLang
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('locale', $locale));

        return $this->translation->matching($criteria)[0] ?? null;
    }

    public function getDisplayName(): string
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('locale', \Locale::getDefault()));

        return $this->translation->matching($criteria)[0]->getName() ?? 'no_name';
    }

    public function getTreeDisplayName(): string
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('locale', \Locale::getDefault()));

        $name = '';
        if ($this->translation->matching($criteria)[0]->getCategory()->getParent() !== null) {
            $name = $this->translation->matching($criteria)[0]->getCategory()->getParent()->getTreeDisplayName() . '->';
        }

        return $name . $this->translation->matching($criteria)[0]->getName() ?? 'no_name';
    }
}
