<?php

namespace Database\Seeders;

use App\Jobs\AddAcountJob;
use App\Services\ReaderAbstract;
use Illuminate\Database\Seeder;

class JsonAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path=storage_path('challenge.json');
        $reader= app(ReaderAbstract::class, ['path'=>$path, 'index'=>0]);
        dispatch(new AddAcountJob($reader));
    }
}
