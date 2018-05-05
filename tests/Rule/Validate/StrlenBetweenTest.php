<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class StrlenBetweenTest extends AbstractValidateTest
{
    protected $min = 4;

    protected $max = 6;

    protected function getArgs()
    {
        return [$this->min, $this->max];
    }

    public function providerIs()
    {
        return [
            ['abcd'],
            ['efghi'],
            ['jklmno'],
            ['абвг'],
            ['ефхев'],
            ['вдгзас'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['abc'],
            ['defghij'],
            ['абв'],
            ['абвддгг'],
        ];
    }
}
