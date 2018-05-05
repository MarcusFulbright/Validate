<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class DateTimeTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        $dt = new \DateTime('Nov 7, 1979, 12:34pm');

        return [
            [[], false, []],
            ['  ', false, '  '],
            ['abcdefghi', false, 'abcdefghi'],
            ['2012-08-02 17:37:29', true, '2012-08-02 17:37:29'],
            [$dt, true, '1979-11-07 12:34:00'],
        ];
    }
}
