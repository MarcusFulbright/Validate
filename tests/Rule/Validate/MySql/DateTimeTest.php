<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use Mbright\Validation\Tests\Rule\Validate\AbstractValidateTest;

class DateTimeTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['1910-01-01 00:00:00'],
            ['1910-01-01T00:00:00'],
            ['2000-12-31 23:59:59'],
            ['2000-12-31T23:59:59'],
        ];
    }

    public function providerIsNot()
    {
        return [
            ['1000-01-01FAKE00:00:00'],
            ['0-01-01T00:00:00'],
            ['9999-12-31 24:59:59'],
            ['9999-12-31 23:60:59'],
            ['9999-12-31 23:60:60'],
            ['9999-13-31 23:60:60'],
            ['9999-12-32 23:60:60'],
            ['10000-12-32 23:60:60'],
        ];
    }
}
