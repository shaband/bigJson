<?php

use App\Jobs\AddAcountJob;
use App\Models\Account;
use App\Services\Reader;
use App\Services\ReaderAbstract;
use Illuminate\Support\Facades\Queue;
use JsonMachine\JsonMachine;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

abstract class AgeCreatorTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    protected $path;


    abstract public function create_reader($index):ReaderAbstract;


    public function test_it_doesnt_add_less_than_eigtheen()
    {
        $reader=$this->create_reader(1);
        $row=iterator_to_array(JsonMachine::fromFile(storage_path("testing.json"), "/1")) ;
        $reader->store();
        $account=   Account::latest()->first();
        $this->assertNotEquals($account?->name, $row['name']);
    }


    public function test_it_doesnt_add_greater_than_sixtyfive()
    {
        $reader=$this->create_reader(0);
        $row=iterator_to_array(JsonMachine::fromFile(storage_path("testing.json"), "/0")) ;
        $reader->store();
        $account=   Account::latest()->first();
        $this->assertNotEquals($account?->name, $row['name']);
    }


    public function test_it_add_null_dates()
    {
        $reader=$this->create_reader(2);
        $row=iterator_to_array(JsonMachine::fromFile(storage_path("testing.json"), "/2")) ;
        $reader->store();
        $account=   Account::latest()->first();
        $this->assertEquals($account?->name, $row['name']);
    }
}
