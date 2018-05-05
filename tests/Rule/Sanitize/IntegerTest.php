<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class IntegerTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []], // cannot sanitize
            ['abc ... 123.45 ,.../', true, 12345],
            ['a-bc .1. alkasldjf 23 aslk.45 ,.../', true, -12345],
            ['1E5', true, 100000],
            ['abc', true, 0],
        ];
    }
}
