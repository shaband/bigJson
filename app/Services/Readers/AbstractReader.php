<?php

declare(strict_types=1);

namespace App\Services\Readers;

use App\Models\Account;
use App\Services\Factories\ReaderFactoryContract;
use App\Services\Filters\FilterContract;
use App\Services\Filters\Source\SourceContract;

abstract class AbstractReader implements ReaderContract
{
    protected ReaderFactoryContract $factory;

    protected FilterContract $filter;

    protected SourceContract $source;

    protected string $filePath;

    public function __construct(ReaderFactoryContract $factory, FilterContract $filter, SourceContract $source)
    {
        $this->factory = $factory;
        $this->filter = $filter;
        $this->source = $source;
    }

    public function initialize(string $filePath, int $index): void
    {
        $this->filePath = $filePath;
        $this->index = $index;
        $this->read();
    }

    public function read()
    {
        $this->source->setOffset($this->index);
        $generator= $this->source->generate($this->filePath, $this->index);
        $this->data = $generator->current();
    }
    public function nextIndex():int
    {
        return $this->index + 1;
    }

    public function MakeNext(): ReaderContract
    {
        return  $this->factory->make();
    }

    public function lastIndex(): bool
    {
        return $this->source->isLast();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    public function store(): void
    {
        if (! $this->filter->isValid($this->data)) {
            return;
        }

        Account::create($this->data);
    }
}
