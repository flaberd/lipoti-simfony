<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Product;

use Lipoti\Shop\Admin\Form\Catalog\Type\ProductEditType;
use Lipoti\Shop\Admin\Manager\ProductManager;
use Lipoti\Shop\Admin\Mapper\Catalog\ProductEntityToProductEditDtoMapper;
use Lipoti\Shop\Core\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductEditController extends AbstractController
{
    private ProductEntityToProductEditDtoMapper $mapper;

    private TranslatorInterface $translator;

    private ProductManager $productManager;

    public function __construct(
        ProductEntityToProductEditDtoMapper $mapper,
        TranslatorInterface $translator,
        ProductManager $productManager
    ) {
        $this->mapper = $mapper;
        $this->translator = $translator;
        $this->productManager = $productManager;
    }

    public function __invoke(Product $product, Request $request): Response
    {
        $session = $request->getSession();

        $productEditDto = ($this->mapper)($product);
        $form = $this->createForm(ProductEditType::class, $productEditDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productManager->update($productEditDto, $product);

            $this->addFlash('success', $this->translator->trans('catalog.product_list.edit_success', [], 'admin'));

            $urlGoBack = $session->get('urlGoBackProduct');
            if ($urlGoBack && $urlGoBack !== $request->getUri()) {
                return $this->redirect($urlGoBack);
            }

            return $this->redirectToRoute('admin_catalog_product_list');
        }

        $session->set('urlGoBackProduct', $request->headers->get('referer'));

        return $this->render('admin/catalog/product/product_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
