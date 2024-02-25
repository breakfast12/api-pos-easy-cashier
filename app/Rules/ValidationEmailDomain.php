<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidationEmailDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = strstr($value, '@');

        if (! $domain || strpos($domain, '.') === false || substr($domain, -1) === '.') {
            $fail('The :attribute must have a domain extension');
        }
    }
}
