<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Category;

use Knp\Component\Pager\PaginatorInterface;
use Lipoti\Shop\Admin\Filter\Catalog\CategoryListFilter;
use Lipoti\Shop\Admin\Form\Catalog\SearchCategoryDto;
use Lipoti\Shop\Admin\Form\Catalog\Type\SearchCategoryType;
use Lipoti\Shop\Core\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryListController extends AbstractController
{
    private PaginatorInterface $paginator;

    private CategoryRepository $categoryRepo;

    public function __construct(PaginatorInterface $paginator, CategoryRepository $categoryRepo)
    {
        $this->paginator = $paginator;
        $this->categoryRepo = $categoryRepo;
    }

    public function __invoke(Request $request): Response
    {
        $searchCategoryDto = new SearchCategoryDto();
        $form = $this->createForm(SearchCategoryType::class, $searchCategoryDto, [
            'method' => 'GET',
        ]);

        $form->handleRequest($request);

        $filter = new CategoryListFilter();
        $filter->setLocale($request->getLocale());

        if ($form->isSubmitted() && $form->isValid()) {
            $filter->setQuery($searchCategoryDto->getQuery());
            $filter->setStatus($searchCategoryDto->getStatus());
        }
        $categoryQuery = $this->categoryRepo->findAllByFilter($filter);

        $pagination = $this->paginator->paginate(
            $categoryQuery, // query NOT result
            $request->query->getInt('page', 1)/* page number */ ,
            15// limit per page
        );

        return $this->render('admin/catalog/category/category_list.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
        ]);
    }
}
