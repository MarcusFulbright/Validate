<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use Mbright\Validation\Tests\Rule\Validate\AbstractValidateTest;

class BitValueTest extends AbstractValidateTest
{
    protected function getArgs()
    {
        return [4];
    }

    public function providerIs()
    {
        return [
            [10],
            [0]
        ];
    }

    public function providerIsNot()
    {
        return [
            [20]
        ];
    }
}
