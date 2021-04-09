<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidSizeCard implements Rule
{
    public const VALID_SIZE = 1;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $values = explode(' ', $value);

        foreach ($values as $card) {
            if (!empty($card) && !$this->scanSize($card)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Scans all cards.
     *
     * @param string $value
     *
     * @return bool
     */
    private function scanSize(string $value): bool
    {
        return strlen($value) === self::VALID_SIZE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The cards must be separeted by space.';
    }
}
