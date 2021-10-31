<?php

use App\Jobs\AddAcountJob;
use App\Models\Account;
use App\Services\ReaderAbstract;
use Illuminate\Support\Facades\Queue;
use JsonMachine\JsonMachine;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

abstract class AddJobCreatorTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    protected $path;


    abstract public function create_reader($index):ReaderAbstract;


    public function test_it_can_read_row()
    {
        $index=0;
        $reader= $this->create_reader($index);
        $data= $reader->toArray();
        $this->assertEquals($data, iterator_to_array(JsonMachine::fromFile(storage_path("challenge.json"), "/$index")));
    }

    public function test_job_push_to_queue()
    {
        Queue::fake();
        $index=0;
        $reader= $this->create_reader($index);
        dispatch(new AddAcountJob($reader));
        Queue::assertPushed(AddAcountJob::class);
    }


    public function test_it_doesnt_continue_if_it_is_the_last_row()
    {
        Queue::fake();
        $reader=       Mockery::mock(ReaderAbstract::class);
        $reader->shouldReceive('lastIndex')->once()->andReturn(true);
        $job=      new AddAcountJob($reader);
        $job->CreateNext();
        Queue::assertNothingPushed();
    }

    public function test_it_continue_if_there_is_next()
    {
        Queue::fake();
        $reader=       Mockery::mock(ReaderAbstract::class);
        $reader->shouldReceive('lastIndex')->once()->andReturn(false);
        $reader->shouldReceive('MakeNext')->once()->andReturnSelf();
        $job= new AddAcountJob($reader);
        $job->CreateNext();
        Queue::assertPushed(AddAcountJob::class);
    }
}
