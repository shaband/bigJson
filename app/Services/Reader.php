<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Rules\ValidAgeRule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator ;
use JsonMachine\JsonMachine;

class Reader extends ReaderAbstract
{
    protected $data ;
    public static function rules()
    {
        return    [
            'date_of_birth'=>['nullable',new ValidAgeRule()]
         ];
    }
    public function __construct(protected string $path, protected int $index)
    {
        $this->path = $path;
        $this->data= JsonMachine::fromFile($this->path, "/$index");
        Log::info("Index is : {$this->index}");
    }


    public function lastIndex():bool
    {
        return  $this->data->getPosition()==filesize($this->path);
    }
    public function nextIndex():int
    {
        return $this->index +1;
    }
    public function MakeNext():ReaderContract
    {
        return new self($this->path, $this->nextIndex());
    }
    public function toArray()
    {
        return iterator_to_array($this->data);
    }

    public function store():void
    {
        $validator=  Validator::make($this->toArray(), self::rules());
        if (!$validator->fails()) {
            Account::create($this->toArray());
        }
    }
}
