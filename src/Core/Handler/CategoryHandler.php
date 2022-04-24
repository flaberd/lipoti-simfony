<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Handler;

use Lipoti\Shop\Core\Entity\Category;
use Lipoti\Shop\Core\Repository\CategoryRepository;
use Twig\Environment;

class CategoryHandler
{
    private CategoryRepository $categoryRepo;

    private Environment $twig;

    public function __construct(CategoryRepository $categoryRepo, Environment $twig)
    {
        $this->categoryRepo = $categoryRepo;
        $this->twig = $twig;
    }

    public function getTree($parent_id = null)
    {
        $result = '';
        $categories = $this->categoryRepo->findBy(
            [
                'parent' => $parent_id,
            ],
            [
                'id' => 'ASC',
            ]
        );

        foreach ($categories as $category) {
            $result .= $this->twig->render('core/parts/category_nav_tree.html.twig', [
                'category' => $category,
                'children' => $this->getTree($category->getId()),
            ]);
//        var_dump($this->twig->render('core/parts/category_nav_tree.html.twig',[
//            'category' => $category,
//            'children' => $this->getTree($category->getId())
//        ]));

//            $result[$category->getId()] =[
//                'category' => $category,
//                'children' => $this->getTree($category->getId())
//            ];
        }

        return $result;
    }
}
