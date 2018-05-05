<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class StrlenMaxTest extends AbstractValidateTest
{
    protected $max = 3;

    protected function getArgs()
    {
        return [$this->max];
    }

    public function providerIs()
    {
        return [
            ['a'],
            ['ab'],
            ['abc'],
            ['а'],
            ['аб'],
            ['абв'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['abcd'],
            ['abcdefg'],
            ['абвг'],
            ['абвгдеж'],
        ];
    }
}
