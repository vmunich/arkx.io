<?php

namespace App\Rules;

use ArkEcosystem\Crypto\Identities\Address as Identity;
use Illuminate\Contracts\Validation\Rule;

class Address implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Identity::validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid address.';
    }
}
