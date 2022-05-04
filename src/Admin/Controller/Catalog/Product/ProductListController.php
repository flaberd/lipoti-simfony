<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Product;

use Knp\Component\Pager\PaginatorInterface;
use Lipoti\Shop\Admin\Filter\Catalog\ProductListFilter;
use Lipoti\Shop\Admin\Form\Catalog\SearchProductDto;
use Lipoti\Shop\Admin\Form\Catalog\Type\SearchProductType;
use Lipoti\Shop\Core\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductListController extends AbstractController
{
    private PaginatorInterface $paginator;

    private ProductRepository $productRepo;

    public function __construct(PaginatorInterface $paginator, ProductRepository $productRepo)
    {
        $this->paginator = $paginator;
        $this->productRepo = $productRepo;
    }

    public function __invoke(Request $request): Response
    {
        $searchCategoryDto = new SearchProductDto();
        $form = $this->createForm(SearchProductType::class, $searchCategoryDto, [
            'method' => 'GET',
        ]);

        $form->handleRequest($request);

        $filter = new ProductListFilter();
        $filter->setLocale($request->getLocale());

        if ($form->isSubmitted() && $form->isValid()) {
            $filter->setName($searchCategoryDto->getName());
        }
        $categoryQuery = $this->productRepo->findAllByFilter($filter);

        $pagination = $this->paginator->paginate(
            $categoryQuery, // query NOT result
            $request->query->getInt('page', 1)/* page number */ ,
            15// limit per page
        );

        return $this->render('admin/catalog/product/product_list.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
        ]);
    }
}
