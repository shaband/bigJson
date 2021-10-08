<?php

namespace App\Jobs;

use App\Models\Account;
use App\Rules\ValidAgeRule;
use App\Services\ReaderAbstract;
use App\Services\RecursionContract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

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
