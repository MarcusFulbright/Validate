<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use Mbright\Validation\Tests\Rule\Validate\AbstractValidateTest;

class TimeTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['-838:59:59'],
            ['838:59:59'],
            ['-838:59:59.99999'],
            ['838:59:59.999999'],
        ];
    }

    public function providerIsNot()
    {
        return [
            ['109712'], // nonsensical minute
            ['105971'], // nonsensical second
            ['-838:59:59:'], // extra delimiter
            ['-838-59-59'], // invalid delimiter
            ['-839:00:00'],
            ['839:00:00'],
            ['-838:59:59.1111111'],
            ['838:59:59.1111111'],
        ];
    }
}
