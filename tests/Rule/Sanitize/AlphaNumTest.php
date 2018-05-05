<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class AlphaNumTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            // value, result, expect
            ['$#% abc () 123 ,./', true, 'abc123'],
            ['$#% abc () 123 влц ,./', true, 'abc123влц'],
        ];
    }
}
