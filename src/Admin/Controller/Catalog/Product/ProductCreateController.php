<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Product;

use Lipoti\Shop\Admin\Form\Catalog\ProductEditDto;
use Lipoti\Shop\Admin\Form\Catalog\Type\ProductEditType;
use Lipoti\Shop\Admin\Manager\ProductManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductCreateController extends AbstractController
{
    private TranslatorInterface $translator;

    private ProductManager $productManager;

    public function __construct(TranslatorInterface $translator, ProductManager $productManager)
    {
        $this->translator = $translator;
        $this->productManager = $productManager;
    }

    public function __invoke(Request $request): Response
    {
        $productEditDto = new ProductEditDto();
        $form = $this->createForm(ProductEditType::class, $productEditDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productManager->create($productEditDto);

            $this->addFlash('success', $this->translator->trans('catalog.product_list.create_success', [], 'admin'));

            return $this->redirectToRoute('admin_catalog_product_list');
        }

        return $this->render('admin/catalog/product/product_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
