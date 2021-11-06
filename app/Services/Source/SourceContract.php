<?php

declare(strict_types=1);

namespace App\Services\Filters\Source;

use Generator;

interface SourceContract
{
    public function setOffset(int $offset): void;
    public function generate(string $path): Generator;
    public function isLast(): Bool;
}
