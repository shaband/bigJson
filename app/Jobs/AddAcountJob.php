<?php

namespace App\Jobs;

use App\Services\ReaderAbstract;
use App\Services\Readers\Reader;

class AddAcountJob extends Job
{
    protected $reader;

    public function __construct(Reader $reader)
    {
        $this->reader=$reader;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->reader->store();

    }

    public function CreateNext(): void
    {
        if (!$this->reader->lastIndex()) {
            dispatch(new AddAcountJob($this->reader->MakeNext()));
        }
    }
}
