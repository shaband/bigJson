<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;

interface ReaderContract
{
    public function __construct(string $path, int $index);
    public function store():void;
}
