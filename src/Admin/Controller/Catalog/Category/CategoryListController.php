<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryListController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        return $this->render('admin/catalog/category/category_list.html.twig');
    }
}
