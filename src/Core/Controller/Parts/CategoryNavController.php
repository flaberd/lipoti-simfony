<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Controller\Parts;

use Lipoti\Shop\Core\Handler\CategoryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryNavController extends AbstractController
{
    private CategoryHandler $categoryHandler;

    public function __construct(CategoryHandler $categoryHandler)
    {
        $this->categoryHandler = $categoryHandler;
    }

    public function __invoke(): Response
    {
//        var_dump($this->categoryHandler->getTree());
        return $this->render('core/parts/category_nav.html.twig', [
            'tree' => $this->categoryHandler->getTree(),
        ]);
    }
}
