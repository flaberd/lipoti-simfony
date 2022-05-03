<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Translation\Type;

use Lipoti\Shop\Admin\Form\Catalog\Translation\CategoryTranslateDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryTranslateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoryTranslateDto::class,
        ]);
    }
}
