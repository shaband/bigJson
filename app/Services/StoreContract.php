<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Fluent;
use JsonMachine\JsonMachine;

interface StoreContract
{
    public function store():void;
}
