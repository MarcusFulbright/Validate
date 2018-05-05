<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class LocaleTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['en_US'],
            ['pt_BR'],
            ['af_ZA'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [""],
            [' '],
            ['en_us'],
            ["Seven 8 nine"],
            ["non:alpha-numeric's"],
            [[]],
        ];
    }
}
