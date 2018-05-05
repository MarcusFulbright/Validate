<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class HexTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            // value, result, expect
            ['$#% abc () 123 ,./', true, 'abc123'],
        ];
    }
}
