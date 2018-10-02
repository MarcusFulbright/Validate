<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use Mbright\Validation\Tests\Rule\Validate\AbstractValidateTest;

class PointNumberTest extends AbstractValidateTest
{
    public function getArgs()
    {
        return [10, 2];
    }

    public function providerIs()
    {
        return [
            [11111111.11],
            [11111111.00],
            [99999999.99],
        ];
    }

    public function providerIsNot()
    {
        return [
            [1111111111],
            ["11111111.11"]
        ];
    }
}
