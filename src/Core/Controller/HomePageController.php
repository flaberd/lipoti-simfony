<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
//    /**
//     * @Route("/{_locale}", name="core_home")
//     */
    public function __invoke(): Response
    {
        return $this->render('core/home_page.html.twig', [
        ]);
    }
}
