<?php

namespace App\Jobs;

use App\Models\Account;
use Illuminate\Contracts\Queue\Queue;
use Traversable;

class FileHandler extends Job
{
    public function __construct(public  Traversable  $accounts)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->accounts as $account) {
        }
    }
}
