<?php

declare(strict_types=1);

namespace App\Provider;

use Faker\Provider\Uuid;

class ShipmentCodeProvider
{
    public function provide(): string
    {
        return (string) Uuid::randomNumber();
    }
}
