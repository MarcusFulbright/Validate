<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class MinTest extends AbstractSanitizeTest
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
            [1, true, 4],
            [2, true, 4],
            [3, true, 4],
            [4, true, 4],
            [5, true, 5],
            [6, true, 6],
        ];
    }
}
