<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class StrlenTest extends AbstractSanitizeTest
{
    protected $len = 4;

    protected function getArgs()
    {
        return [$this->len];
    }

    public function providerTo()
    {
        return [
            [[], false, []],
            ['a', true, 'a   '],
            ['abcd', true, 'abcd'],
            ['abcdef', true, 'abcd'],
            ['ж', true, 'ж   '],
            ['абвг', true, 'абвг'],
            ['абвгде', true, 'абвг'],
        ];
    }
}
