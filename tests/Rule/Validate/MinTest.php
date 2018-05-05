<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class MinTest extends AbstractValidateTest
{
    protected $min = 4;

    protected function getArgs()
    {
        return [$this->min];
    }

    public function providerIs()
    {
        return [
            [4],
            [5],
            [6],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [1],
            [2],
            [3],
        ];
    }
}
