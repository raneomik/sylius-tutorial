<?php

use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import('vendor/sylius-labs/coding-standard/ecs.php');
    $containerConfigurator->import(SetList::SYMFONY_RISKY);
    $containerConfigurator->import(SetList::SYMFONY);

    $containerConfigurator->services()->set(BinaryOperatorSpacesFixer::class)->call('configure', [[]]);
};
