<?php

declare(strict_types=1);

namespace App\Services\Factories;

use App\Services\Readers\ReaderContract;

interface ReaderFactoryContract
{
    public function make(): ReaderContract;
}
