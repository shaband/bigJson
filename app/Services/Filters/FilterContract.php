<?php

declare(strict_types=1);

namespace App\Services\Filters;

interface FilterContract
{
    public function isValid(array $data): bool;
}
