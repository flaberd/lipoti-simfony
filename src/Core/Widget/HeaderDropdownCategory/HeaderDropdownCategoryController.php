<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Widget\HeaderDropdownCategory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HeaderDropdownCategoryController extends AbstractController
{
    private HeaderDropdownCategoryHandler $categoryHandler;

    public function __construct(HeaderDropdownCategoryHandler $categoryHandler)
    {
        $this->categoryHandler = $categoryHandler;
    }

    public function __invoke(): Response
    {
        return $this->render('core/widget/header_dropdown_category/index.html.twig', [
            'tree' => $this->categoryHandler->getTree(),
        ]);
    }
}
