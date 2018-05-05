<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class StrlenMaxTest extends AbstractSanitizeTest
{
    protected $max = 3;

    protected function getArgs()
    {
        return [$this->max];
    }

    public function providerTo()
    {
        return [
            [[],   false, []],
            ['a',       true, 'a'],
            ['abc',     true, 'abc'],
            ['abcd',    true, 'abc'],
            ['abcdefg', true, 'abc'],
            ['ж',       true, 'ж'],
            ['абв',     true, 'абв'],
            ['абвг',    true, 'абв'],
            ['абвгдеж', true, 'абв'],
        ];
    }
}
