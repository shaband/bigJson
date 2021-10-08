<?php

namespace App\Models;

use App\Rules\ValidAgeRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Account extends Model
{


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'date_of_birth'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
            'credit_card'=>'array',

        ];
    public function setDateOfBirthAttribute($date)
    {
        if ($date!=null) {
            $this->attributes['date_of_birth']=  Carbon::parse((new ValidAgeRule)->fixDate($date));
        }
    }
}
