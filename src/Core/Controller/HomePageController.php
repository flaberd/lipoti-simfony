<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('core/home_page.html.twig', [
        ]);
    }
}
