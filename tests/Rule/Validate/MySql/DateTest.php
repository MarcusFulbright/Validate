<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use Mbright\Validation\Tests\Rule\Validate\AbstractValidateTest;

class DateTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['2012-12-31'],
            ['2012/12/31'],
            ['2012^12^31'],
            ['2012@12@31'],
            ['20070523'],
            ['070523'],
            [19830905],
            [830905],
        ];
    }

    public function providerIsNot()
    {
        return [
            ['2012a12a31'],
            ['071332'],
            [time()],
            [071332],
        ];
    }
}
