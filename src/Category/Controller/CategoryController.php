<?php

declare(strict_types=1);

namespace Lipoti\Shop\Category\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Lipoti\Shop\Category\Repository\CategoryRepository;
use Lipoti\Shop\Core\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    private PaginatorInterface $paginator;

    private CategoryRepository $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo, PaginatorInterface $paginator)
    {
        $this->categoryRepo = $categoryRepo;
        $this->paginator = $paginator;
    }

    public function __invoke(Category $category, Request $request): Response
    {
//        $category = $this->categoryRepo->
//        $categoryQuery = $this->categoryRepo->findAllByFilter($filter);
//
//        $pagination = $this->paginator->paginate(
//            $categoryQuery, // query NOT result
//            $request->query->getInt('page', 1)/* page number */ ,
//            15// limit per page
//        );

        return $this->render('category/category.html.twig', [
        ]);
    }
}
