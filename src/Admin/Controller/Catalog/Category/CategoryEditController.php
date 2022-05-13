<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Controller\Catalog\Category;

use Lipoti\Shop\Admin\Form\Catalog\Type\CategoryEditType;
use Lipoti\Shop\Admin\Manager\CategoryManager;
use Lipoti\Shop\Admin\Mapper\Catalog\CategoryEntityToCategoryEditDtoMapper;
use Lipoti\Shop\Core\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class CategoryEditController extends AbstractController
{
    private CategoryEntityToCategoryEditDtoMapper $mapper;

    private TranslatorInterface $translator;

    private CategoryManager $categoryManager;

    public function __construct(
        CategoryEntityToCategoryEditDtoMapper $mapper,
        TranslatorInterface $translator,
        CategoryManager $categoryManager
    ) {
        $this->mapper = $mapper;
        $this->translator = $translator;
        $this->categoryManager = $categoryManager;
    }

    public function __invoke(Category $category, Request $request): Response
    {
        $session = $request->getSession();

        $categoryEditDto = ($this->mapper)($category);
        $form = $this->createForm(CategoryEditType::class, $categoryEditDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryManager->update($categoryEditDto, $category);

            $this->addFlash('success', $this->translator->trans('catalog.category_list.edit_success', [], 'admin'));

            $urlGoBack = $session->get('urlGoBackCategory');
            if ($urlGoBack && $urlGoBack !== $request->getUri()) {
                return $this->redirect($urlGoBack);
            }

            return $this->redirectToRoute('admin_catalog_category_list');
        }
        $session->set('urlGoBackCategory', $request->headers->get('referer'));

        return $this->render('admin/catalog/category/category_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
