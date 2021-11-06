<?php

declare(strict_types=1);

namespace App\Services\Source;

use App\Services\Filters\Source\SourceContract;
use Generator;
use JsonMachine\JsonMachine;

class JsonSource implements SourceContract
{
    protected JsonMachine $machine;

    protected int $fileSize;
    protected string $offset;
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }
    public function generate(string $path): Generator
    {
        $this->machine::fromFile($path, "/{$this->offset}");
        $this->fileSize=filesize($path);
        foreach ($this->machine as $item) {
            yield $item;
        }
    }
    public function isLast(): bool
    {
        return $this->machine->getPosition()===$this->fileSize;
    }
}
