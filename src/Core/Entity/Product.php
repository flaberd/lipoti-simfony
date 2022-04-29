<?php


namespace Lipoti\Shop\Core\Entity;


use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Lipoti\Shop\Common\Entity\Traits\IdentifiableEntityTrait;
use Lipoti\Shop\Common\Entity\Traits\TimestampableEntityTrait;

/**
 * @ORM\Entity
 */
class Product
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
    private Category $category;

//    /**
//     * @ORM\OneToMany(targetEntity=CategoryLang::class, mappedBy="category")
//     */
//    private Collection $translation;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true, length=255)
     */
    private string $slug;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function getTranslation(): Collection
    {
        return $this->translation;
    }

    /**
     * @param Collection $translation
     */
    public function setTranslation(Collection $translation): void
    {
        $this->translation = $translation;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}