<?php

declare(strict_types=1);

namespace Lipoti\Shop\Admin\Form;

use Lipoti\Shop\Common\Component\Form\Type\ArrayNameKeyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TranslationArrayNameKeyType extends ArrayNameKeyType
{
    private array $locales;

    public function __construct(array $locales)
    {
        $this->locales = $locales;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => TextType::class,
            'name_key' => $this->locales,
        ]);
    }
}
