<?php

declare(strict_types=1);

namespace App\Piplines;

use Closure;

class RowFixerPipline
{
    protected $prefix='credit_card/';
    public function handle($content, Closure $next)
    {
        $content= collect($content)->reduceWithKeys(function ($carry, $value, $key) {
            $value=$this->fixBoolean($value);
            $value=$this->fixNull($value);
            if (!$this->startWith($key)) {
                $carry[$key]=$value;
                return $carry;
            }
            $carry['credit_card'][$this->getCreditKey($key)]=$value;
            return $carry;
        }, []);

        return $next($content);
    }

    /**
     *
     * Description for function
     *
     * @param    string  $key
     * @return      bool
     *
     */
    public function startWith(string $key) :bool
    {
        return strpos($key, $this->prefix)===0;
    }



    /**
     *
     * Description for function
     *
     * @param    string  $key
     * @return    string
     *
     */
    public function getCreditKey(string $key):string
    {
        return  str_replace($this->prefix, '', $key);
    }

    /**
     * fix empty strings to be null
     *
     * @param  mixed $value
     * @return void
     */
    public function fixNull($value)
    {
        return  is_string($value) && $value === '' ? null : $value;
    }

    /**
     * change string true false to boolean
     *
     * @param  mixed $value
     * @return mixed
     */
    public function fixBoolean($value)
    {
        return in_array($value, ['true','false'])?filter_var($value, FILTER_VALIDATE_BOOLEAN):$value;
    }
}
