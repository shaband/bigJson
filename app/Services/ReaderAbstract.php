<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Support\Arrayable;

abstract class ReaderAbstract implements ReaderContract, StoreContract, RecursionContract, Arrayable
{
}
