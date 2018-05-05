<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class MaxTest extends AbstractSanitizeTest
{
    protected $max = 3;

    protected function getArgs()
    {
        return [$this->max];
    }

    public function providerTo()
    {
        return [
            [[], false, []],
            [1, true, 1],
            [2, true, 2],
            [3, true, 3],
            [4, true, 3],
            [5, true, 3],
            [6, true, 3],
        ];
    }
}
