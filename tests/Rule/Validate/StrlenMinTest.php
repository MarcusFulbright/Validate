<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class StrlenMinTest extends AbstractValidateTest
{
    protected $min = 4;

    protected function getArgs()
    {
        return [$this->min];
    }

    public function providerIs()
    {
        return [
            ['abcd'],
            ['efghijkl'],
            ['абвг'],
            ['абвгабав'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['a'],
            ['ab'],
            ['abc'],
            ['а'],
            ['аб'],
            ['абв'],
        ];
    }
}
