<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Rules\ValidAgeRule;
use Illuminate\Support\Facades\Validator ;
use Spatie\SimpleExcel\SimpleExcelReader;

class ExcelReader extends ReaderAbstract
{
    protected $data ;

    public function __construct(protected string $path, protected int $index)
    {
        $this->path = $path;

        $this->data=  SimpleExcelReader::create(storage_path('challenge.csv'))
        ->skip($this->index)
        ->take(1)
        ->getRows();
    }


    public function lastIndex():bool
    {
        return  $this->data->last()===$this->toArray();
    }

    public function toArray()
    {
        return $this->data->first();
    }

    public function store():void
    {
        $data=$this->dataWithCreditArray();
        $validator=  Validator::make($data, self::rules());
        if (!$validator->fails()) {
            Account::create($data);
        }
    }

    /**
     * convert credit_card/* to array contains its details
     *
     * @return array
     */
    public function dataWithCreditArray(): array
    {
        return  collect($this->toArray())->reduceWithKeys(function ($carry, $value, $key) {
            $prefix= 'credit_card/';
            if (strpos($key, $prefix)===0) {
                $new_key= str_replace($prefix, '', $key);
                $carry['credit_card'][$new_key]=$value;
            } else {
                $carry[$key]=$value;
            }

            return $carry;
        }, []);
    }
}
