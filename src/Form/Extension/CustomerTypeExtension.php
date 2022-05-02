<?php

declare(strict_types=1);

namespace App\Form\Extension;

use Sylius\Bundle\CustomerBundle\Form\Type\CustomerType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerTypeExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [CustomerType::class];
    }

    /**
     * @param array<string, string> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('taxNumber', null, [
            'required' => false,
        ]);
    }
}
