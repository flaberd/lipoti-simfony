<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form\Catalog\Type;

use Lipoti\Shop\Admin\Form\Catalog\Translation\Type\CategoryTranslateType;
use Lipoti\Shop\Admin\Form\TranslationArrayNameKeyType;
use Lipoti\Shop\Core\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'common.status_false' => 0,
                    'common.status_true' => 1,
                ],
                'choice_translation_domain' => 'admin_forms',
                'label' => false,
            ])
            ->add('parent', EntityType::class, [
                'class' => Category::class,
                'choice_label' => fn ($category) => $category->getTreeDisplayName(),
                'multiple' => false,
                'expanded' => false,
                'label' => false,
                'required' => false,
                'placeholder' => 'noCategory',
            ])
            ->add('slug', TextType::class, [
                'required' => false,
            ])
            ->add('translation', TranslationArrayNameKeyType::class, [
                'entry_type' => CategoryTranslateType::class,
            ])
            ->add('submit', SubmitType::class)
        ;
    }
}
