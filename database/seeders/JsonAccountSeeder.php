<?php

namespace Database\Seeders;

use App\Jobs\AddAcountJob;
use App\Services\ReaderAbstract;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JsonAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->truncate();
        DB::table('failed_jobs')->truncate();
        DB::table('accounts')->truncate();
        $path=storage_path('challenge.json');
        $reader= app(ReaderAbstract::class, ['path'=>$path, 'index'=>0]);
        dispatch(new AddAcountJob($reader));
    }
}
