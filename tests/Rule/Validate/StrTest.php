<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class StrTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            [12345],
            [123.45],
            [true],
            [false],
            ['string'],
            ['абвдеж'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [new \StdClass],
        ];
    }
}
