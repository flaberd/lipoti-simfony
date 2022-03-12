<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Controller\Parts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryNavController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('core/parts/category_nav.html.twig', [
        ]);
    }
}
