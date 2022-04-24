<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Widget\HeaderDropdownCategory;

use Lipoti\Shop\Core\Repository\CategoryRepository;
use Twig\Environment;

class HeaderDropdownCategoryHandler
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
            $result .= $this->twig->render('core/widget/header_dropdown_category/category_nav_tree.html.twig', [
                'category' => $category,
                'children' => $this->getTree($category->getId()),
            ]);
        }

        return $result;
    }
}
