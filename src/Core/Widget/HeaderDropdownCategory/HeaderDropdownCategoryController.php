<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Widget\HeaderDropdownCategory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HeaderDropdownCategoryController extends AbstractController
{
    private HeaderDropdownCategoryHandler $categoryHandler;

    public function __construct(HeaderDropdownCategoryHandler $categoryHandler)
    {
        $this->categoryHandler = $categoryHandler;
    }

    public function __invoke()
    {
        return $this->render('core/widget/header_dropdown_category/index.html.twig', [
            'tree' => $this->categoryHandler->getTree(),
        ]);
    }
}
