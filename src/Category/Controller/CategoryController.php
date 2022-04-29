<?php

declare(strict_types=1);

namespace Lipoti\Shop\Category\Controller;

use Lipoti\Shop\Core\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    public function __invoke(Category $category, Request $request): Response
    {
        return $this->render('category/category.html.twig', [
        ]);
    }
}
