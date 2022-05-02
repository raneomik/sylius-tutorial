<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('icon');
        $builder->add('text');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('configuration');
        $resolver->setDefined('locale_code');
    }
}
