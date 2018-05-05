<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class StrlenMinTest extends AbstractSanitizeTest
{
    protected $min = 4;

    protected function getArgs()
    {
        return [$this->min];
    }

    public function providerTo()
    {
        return [
            [[], false, []],
            ['a', true, 'a   '],
            ['abcd', true, 'abcd'],
            ['abcdefg', true, 'abcdefg'],
            ['г', true, 'г   '],
            ['абвг', true, 'абвг'],
            ['абвгдеж', true, 'абвгдеж'],
        ];
    }
}
