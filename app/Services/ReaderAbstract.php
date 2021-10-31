<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Rules\ValidAgeRule;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Validator;

abstract class ReaderAbstract implements ReaderContract, StoreContract, RecursionContract, Arrayable
{
    public static function rules()
    {
        return    [
            'date_of_birth'=>['nullable',new ValidAgeRule()]
         ];
    }
    public function nextIndex():int
    {
        return $this->index +1;
    }
    public function MakeNext():ReaderContract
    {
        return app(ReaderAbstract::class, ['index'=>$this->nextIndex()]);
    }
    public function store():void
    {
        $validator=  Validator::make($this->toArray(), self::rules());
        if (!$validator->fails()) {
            Account::create($this->toArray());
        }
    }
}
