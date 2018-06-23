<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class StrBetweenTest extends AbstractSanitizeTest
{
    protected $min = 4;

    protected $max = 6;

    protected function getArgs()
    {
        return [$this->min, $this->max];
    }

    public function providerTo()
    {
        return [
            [[], false, []],
            ['abc',  true, 'abc '],
            ['abcd', true, 'abcd'],
            ['abcde', true, 'abcde'],
            ['abcdef', true, 'abcdef'],
            ['abcdefg', true, 'abcdef'],
            ['abcdefgh', true, 'abcdef'],
            ['абв', true, 'абв '],
            ['абвг', true, 'абвг'],
            ['абвгд', true, 'абвгд'],
            ['абвгде', true, 'абвгде'],
            ['абвгдеж', true, 'абвгде'],
            ['абвгдежз', true, 'абвгде'],
        ];
    }
}
