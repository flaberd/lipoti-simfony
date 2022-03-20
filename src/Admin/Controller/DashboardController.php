<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
}
