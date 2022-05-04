<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'label' => false,
            ])
//            ->add('status', ChoiceType::class, [
//                'required' => false,
//                'choices' => [
//                    'catalog.category_list.filter_choise_element_false' => '0',
//                    'catalog.category_list.filter_choise_element_true' => '1',
//                ],
//                'choice_translation_domain' => 'admin_forms',
//                'label' => false,
//            ])
            ->add('submit', SubmitType::class)
        ;
    }
}
