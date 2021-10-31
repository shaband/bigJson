<?php

use App\Jobs\AddAcountJob;
use App\Services\Reader;
use App\Services\ReaderAbstract;
use Illuminate\Support\Facades\Queue;
use JsonMachine\JsonMachine;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CSVAddJobTest extends AddJobCreatorTest
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    protected $path;

    public function setUp(): void
    {
        parent::setUp();

        $this->path=storage_path("challenge.json");
    }
    public function create_reader($index):ReaderAbstract
    {
        return       app(Reader::class, ['path'=>$this->path, 'index'=>$index]);
    }
}
