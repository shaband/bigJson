<?php

declare(strict_types=1);

namespace App\Services\Readers;

interface ReaderContract
{


    public function initialize(string $filePath, int $index): void;
    public function store(): void;
}
