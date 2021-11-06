<?php

declare(strict_types=1);

namespace App\Services\Filters;

class JsonFilterContract implements FilterContract
{
    /**
     * @param array $data
     * @return bool
     */
    public function isValid(array $data): bool
    {
        return true;
    }
}
{

}
