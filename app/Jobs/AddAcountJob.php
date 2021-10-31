<?php

namespace App\Jobs;

use App\Services\ReaderAbstract;

class AddAcountJob extends Job
{
    protected $reader;

    public function __construct(ReaderAbstract $reader)
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

        $this->CreateNext();
    }

    public function CreateNext(): void
    {
        if (!$this->reader->lastIndex()) {
            dispatch(new AddAcountJob($this->reader->MakeNext()));
        }
    }
}
