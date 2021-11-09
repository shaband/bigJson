<?php

declare(strict_types=1);

namespace App\Services\Factories;

use App\Services\Filters\JsonFilter;
use App\Services\Readers\Reader;
use App\Services\Readers\ReaderContract;
use App\Services\Source\JsonSource;

class JsonReaderFactory implements ReaderFactoryContract
{
    public function make(): ReaderContract
    {
        return new Reader(
            $this,
            new JsonFilter(),
            new JsonSource()
        );
    }
}
