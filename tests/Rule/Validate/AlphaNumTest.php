<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class AlphaNumTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            [0],
            [1],
            [2],
            [5],
            ['0'],
            ['1'],
            ['2'],
            ['5'],
            ['alphaonly'],
            ['AlphaOnLy'],
            ['someThing8else'],
            ['soЗѝЦЯng8else'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [""],
            [' '],
            ["Seven 8 nine"],
            ["non:alpha-numeric's"],
            ['ЕФГ35%-№'],
            [[]],
        ];
    }
}
