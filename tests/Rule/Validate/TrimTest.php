<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class TrimTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['abc'],
            ['абв'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [' abc '],
            [' абв '],
        ];
    }
}
