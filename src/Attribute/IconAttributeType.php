<?php

declare(strict_types=1);

namespace App\Attribute;

use Sylius\Component\Attribute\AttributeType\AttributeTypeInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class IconAttributeType implements AttributeTypeInterface
{
    public const TYPE_ICON = 'icon';

    public function getStorageType(): string
    {
        return AttributeValueInterface::STORAGE_JSON;
    }

    public function getType(): string
    {
        return self::TYPE_ICON;
    }

    /**
     * @param array<string, string> $configuration
     */
    public function validate(
        AttributeValueInterface $attributeValue,
        ExecutionContextInterface $context,
        array $configuration
    ): void {
    }
}
