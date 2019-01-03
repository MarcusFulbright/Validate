<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use Mbright\Validation\Tests\Rule\Validate\AbstractValidateTest;

class YearTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            [1901],
            [2155],
            [2000],
        ];
    }

    public function providerIsNot()
    {
        return [
            [1900],
            [2156],
            ['1900'],
            ['2156'],
        ];
    }
}
