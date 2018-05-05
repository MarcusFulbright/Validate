<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class WordTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            ['abc _ 123 - ,./', true, 'abc_123'],
            ['abc _ 123 фвг - ,./', true, 'abc_123фвг'],
        ];
    }
}
