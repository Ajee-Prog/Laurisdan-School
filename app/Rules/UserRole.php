<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class UserRole implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $allowedRoles = ['admin', 'teacher', 'student', 'parent'];

        if (! in_array($value, $allowedRoles)) {
            $fail('The selected :attribute is invalid.');
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
