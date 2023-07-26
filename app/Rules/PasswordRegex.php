<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRegex implements ValidationRule
{
    /**
     * Validate password.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.{8,}).*$/', $value)) {
            $fail(__('passwords.regex'));
        }
    }
}
