<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class CreditCardTest extends AbstractValidateTest
{
    public function providerIs()
    {
        // stolen from Respect Validate testing
        return [
            ['5376 7473 9720 8720'], // MasterCard
            ['4024.0071.5336.1885'], // Visa 16
            ['4024 007 193 879'], // Visa 13
            ['340-3161-9380-9364'], // AmericanExpress
            ['30351042633884'], // Dinners
        ];
    }

    public function providerIsNot()
    {
        // stolen from Respect Validate testing
        return [
            [''],
            ['it isnt my credit card number'],
            ['&stR@ng3|] array(|-|@r$'],
            [''],
            ['1234 1234 1234 1234'],
            ['1234.1234.1234.1234'],
        ];
    }
}
