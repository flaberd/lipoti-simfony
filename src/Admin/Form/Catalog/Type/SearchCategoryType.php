<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('query', TextType::class, [
                'required' => false,
                'label' => false,
            ])
//            ->add('status', ChoiceType::class, [
//                'required' => false,
//                'choices' => [
//                    Post::STATUS_DRAFT => Post::STATUS_DRAFT,
//                    Post::STATUS_DELAYED => Post::STATUS_DELAYED,
//                    Post::STATUS_PUBLISHED => Post::STATUS_PUBLISHED,
//                    Post::STATUS_BLOCKED => Post::STATUS_BLOCKED,
//                    Post::STATUS_ARCHIVED => Post::STATUS_ARCHIVED,
//                ],
//                'label' => 'Status',
//            ])
            ->add('submit', SubmitType::class)
        ;
    }
}
