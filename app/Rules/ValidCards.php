<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCards implements Rule
{
    public const VALID_CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $values
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $values = explode(' ', $value);

        foreach ($values as $card) {
            if (!$this->scanValues(strtoupper($card))) {
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
    private function scanValues(string $value): bool
    {
        return in_array($value, self::VALID_CARDS, true);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        $valid_cards = implode(', ', self::VALID_CARDS);

        return "The cards must be in $valid_cards.";
    }
}
