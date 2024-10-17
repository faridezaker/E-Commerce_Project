<?php

namespace Zaker\User\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateMobile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match("/^9[0-9]{9}$/", $value)) {
            $fail('The mobile number format is not correct, for example 9367788755');
        }
    }
}
