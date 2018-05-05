<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class HexTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['abcdef'],
            ['01234f'],
            ['a1b2c3'],
            ['ffffff'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [""],
            [' '],
            ["Seven 8 nine"],
            ["non:alpha-numeric's"],
            [[]],
        ];
    }
}
