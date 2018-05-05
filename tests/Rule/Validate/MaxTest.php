<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class MaxTest extends AbstractValidateTest
{
    protected $max = 3;

    protected function getArgs()
    {
        return [$this->max];
    }

    public function providerIs()
    {
        return [
            [1],
            [2],
            [3],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [4],
            [5],
            [6],
        ];
    }
}
