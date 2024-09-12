<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Gtin implements Rule
{
    public function passes($attribute, $value)
    {
        if (!preg_match('/^\d{8}|\d{12}|\d{13}|\d{14}$/', $value)) {
            return false;
        }

        return $this->isValidGtinChecksum($value);
    }

    public function message()
    {
        return 'The :attribute is not a valid GTIN.';
    }

    private function isValidGtinChecksum($gtin)
    {
        $gtin = str_pad($gtin, 14, '0', STR_PAD_LEFT);

        $sum = 0;
        for ($i = 0; $i < 14; $i++) {
            $digit = (int) $gtin[$i];
            $sum += ($i % 2 === 0) ? $digit : $digit * 3;
        }

        return $sum % 10 === 0;
    }
}