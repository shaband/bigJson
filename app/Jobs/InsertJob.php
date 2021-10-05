<?php

namespace App\Jobs;

use App\Models\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Facades\Log;
use JsonMachine\JsonMachine;

class InsertJob extends Job
{
    public function __construct(public int $index=0)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $account= JsonMachine::fromFile(storage_path('challenge.json'), "/$this->index");
        Log::info(iterator_to_array($account)['name']);
        $next=(int) ((int) $this->index)+1;
        dispatch(new InsertJob($next));
    }
}
