<?php

declare(strict_types=1);

namespace App\Services\Factories;

use App\Services\Filters\JsonFilterContract;
use App\Services\Readers\Reader;
use App\Services\Readers\ReaderContract;
use App\Services\Source\JsonSource;

class JsonReaderFactory implements ReaderFactoryContract
{
    public function make(): ReaderContract
    {
        return new Reader(
            $this,
            new JsonFilterContract(),
            new JsonSource()
        );
    }
}
