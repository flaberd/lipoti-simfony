<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Category;

use Lipoti\Shop\Admin\Form\Catalog\CategoryEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Type\CategoryEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryEditController extends AbstractController
{
    public function __invoke()
    {
        $categoryEditDto = new CategoryEditDto();
        $form = $this->createForm(CategoryEditType::class, $categoryEditDto);

        return $this->render('admin/catalog/category/category_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
