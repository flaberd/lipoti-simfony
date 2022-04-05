<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Category;

use Lipoti\Shop\Admin\Form\Catalog\Type\CategoryEditType;
use Lipoti\Shop\Admin\Mapper\Catalog\CategoryEntityToCategoryEditDtoMapper;
use Lipoti\Shop\Core\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryEditController extends AbstractController
{
    private CategoryEntityToCategoryEditDtoMapper $mapper;

    public function __construct(CategoryEntityToCategoryEditDtoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function __invoke(Category $category, Request $request): Response
    {
        $categoryEditDto = ($this->mapper)($category);
        $form = $this->createForm(CategoryEditType::class, $categoryEditDto);

        return $this->render('admin/catalog/category/category_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
