<?php

declare(strict_types=1);

namespace App\Services;

use App\Rules\ValidAgeRule;
use Illuminate\Contracts\Support\Arrayable;

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
        return app(ReaderAbstract::class, ['path'=>$this->path, 'index'=>$this->nextIndex()]);
    }
}
