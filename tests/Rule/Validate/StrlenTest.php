<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class StrlenTest extends AbstractValidateTest
{
    protected $len = 4;

    protected function getArgs()
    {
        return [$this->len];
    }

    public function providerIs()
    {
        return [
            ['abcd'],
            ['efgh'],
            ['абвв'],
            ['фгег'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['abc'],
            ['defgh'],
            ['абв'],
            ['абвгд'],
        ];
    }
}
