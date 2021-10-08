<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;
use Prophecy\Call\Call;

class ValidAgeRule implements Rule
{
    protected int $min_age=18;
    protected int $max_age=65;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $age=$this->getAge($value);
        return $this->betweenCriterias($age);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'Age Is Not Valid';
    }


    public function fixDate($date): string
    {
        return str_replace('/', '-', $date);
    }
    protected function getAge($date):int
    {
        $date=$this->fixDate($date);
        return Carbon::parse($date)->diffInYears(Carbon::now());
    }

    protected function betweenCriterias($age)
    {
        return ($this->min_age <=$age && $age<=$this->max_age);
    }
}
