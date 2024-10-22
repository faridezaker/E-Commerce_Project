<?php

namespace Zaker\User\Rules;

use Illuminate\Contracts\Validation\Rule;

class    ValidateMobile implements Rule
{
    /**
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool) preg_match("/^9[0-9]{9}$/", $value);
    }

    /**
     *
     * @return string
     */
    public function message()
    {
        return 'The mobile number format is not correct, for example 9367788755';
    }
}
