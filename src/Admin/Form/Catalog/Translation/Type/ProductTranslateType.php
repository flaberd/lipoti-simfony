<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Translation\Type;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Lipoti\Shop\Admin\Form\Catalog\Translation\ProductTranslateDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductTranslateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', CKEditorType::class, [
//                'config' => [
//                    'toolbar' => 'full'
//                ],
                'config_name' => 'basic_config',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductTranslateDto::class,
        ]);
    }
}
