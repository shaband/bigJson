<?php

declare(strict_types=1);

namespace App\Services\Source;

use App\Services\Source\SourceContract;
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
        $this->JsonMachine= JsonMachine::fromFile($path);
        $this->fileSize=filesize($path);
        foreach ($this->JsonMachine as$index=> $item) {
            yield $index=>$item;
        }
    }
    public function isLast(): bool
    {
        return $this->machine->getPosition()===$this->fileSize;
    }
}
