<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Widget\SidebarMenu;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class SidebarMenuController extends AbstractController
{
    private TranslatorInterface $translator;

    private SidebarMenuHandler $sidebarMenuHandler;

    public function __construct(TranslatorInterface $translator, SidebarMenuHandler $sidebarMenuHandler)
    {
        $this->translator = $translator;
        $this->sidebarMenuHandler = $sidebarMenuHandler;
    }

    public function __invoke(string $path = null): Response
    {
        // dashboard
        $dashboard = new SidebarMenuItem();
        $dashboard->setName($this->translator->trans('sidebar_menu.dashboard', [], 'admin'));
        $dashboard->setPath('admin_dashboard');
        $dashboard->setIcon('fas fa-tachometer-alt');
        $dashboard->setActive($path === 'admin_dashboard');
        $menu[] = $dashboard;

        // catalog
        $category = new SidebarMenuItem();
        $category->setName($this->translator->trans('sidebar_menu.category', [], 'admin'));
        $category->setPath('admin_catalog_category_list');
        $category->setIndicatorPath([
            'admin_catalog_category_list',
            'admin_catalog_category_edit',
        ]);
        $category->setActive(\in_array($path, $category->getIndicatorPath(), true));
        $catalogChildren[] = $category;

        $product = new SidebarMenuItem();
        $product->setName($this->translator->trans('sidebar_menu.product', [], 'admin'));
        $product->setPath('admin_catalog_product_list');
        $product->setIndicatorPath([
            'admin_catalog_product_list',
            'admin_catalog_product_edit',
        ]);
        $product->setActive(\in_array($path, $product->getIndicatorPath(), true));
        $catalogChildren[] = $product;

        $catalog = new SidebarMenuItem();
        $catalog->setName($this->translator->trans('sidebar_menu.catalog', [], 'admin'));
        $catalog->setIcon('fas fa-archive');
        $catalog->setActive($this->sidebarMenuHandler->checkActive($catalogChildren, $path));
        $catalog->setChildren($catalogChildren);
        $menu[] = $catalog;
        // end catalog

        // logout
        $logout = new SidebarMenuItem();
        $logout->setName($this->translator->trans('sidebar_menu.logout', [], 'admin'));
        $logout->setPath('admin_logout');
        $logout->setIcon('fas fa-sign-out-alt');
        $logout->setActive(false);
        $menu[] = $logout;

        return $this->render('admin/widget/sidebar_menu/sidebar_menu.html.twig', [
            'menu' => $menu,
        ]);
    }
}
