<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Widget;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class SidebarMenuController extends AbstractController
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function __invoke(string $path = null): Response
    {
        $menu[] = [
            'name' => $this->translator->trans('sidebar_menu.dashboard', [], 'admin'),
            'path' => 'admin_dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'active' => $path === 'admin_dashboard',
            'children' => [],
        ];

        $catalogChildren[] = [
            'name' => $this->translator->trans('sidebar_menu.category', [], 'admin'),
            'path' => 'admin_catalog_category_list',
            'icon' => '',
            'active' => $path === 'admin_catalog_category_list',
        ];

        $menu[] = [
            'name' => $this->translator->trans('sidebar_menu.catalog', [], 'admin'),
            'path' => '',
            'icon' => 'fas fa-archive',
            'active' => array_search($path, array_column($catalogChildren, 'path'), true),
            'children' => $catalogChildren,
        ];

        $menu[] = [
            'name' => $this->translator->trans('sidebar_menu.logout', [], 'admin'),
            'path' => 'admin_logout',
            'icon' => 'fas fa-sign-out-alt',
            'active' => false,
            'children' => [],
        ];

        return $this->render('admin/parts/sidebar_menu.html.twig', [
            'menu' => $menu,
        ]);
    }
}
