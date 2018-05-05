<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class DoubleTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []], // can't fix
            [123.45, true, 123.45],
            ['abc ... 123.45 ,.../', true, 123.450],
            ['a-bc .1. alkasldjf 23 aslk.45 ,.../', true, -.123450],
            ['1E5', true, 100000.0],
        ];
    }
}
