<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Piplines\RowFixerPipline;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelReader extends ReaderAbstract
{
    protected $data ;
    protected SimpleExcelReader $reader ;


    public function __construct(protected string $path, protected int $index)
    {
        $this->path = $path;
        $this->reader=SimpleExcelReader::create($path);
    }


    public function lastIndex():bool
    {
        return  $this->reader->getRows()->last()===$this->data;
    }


    public function getRow():array
    {
        return  $this->reader->getRows()
            ->skip($this->index)
            ->take(1)
            ->first();
    }
    public function toArray()
    {
        return  app(Pipeline::class)
            ->send($this->getRow())
            ->through(RowFixerPipline::class)
            ->then(fn ($content) =>$content);
    }
}
