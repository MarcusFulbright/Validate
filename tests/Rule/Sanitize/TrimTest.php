<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class TrimTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            [' abc ', true, 'abc'],
            [' абв ', true, 'абв'],
        ];
    }
}
