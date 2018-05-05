<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class AlphaTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['alphaonly'],
            ['AlphaOnly'],
            ['AlphaOnlyБуква'],
            ['самоБуква'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [' '],
            [''],
            [0],
            [1],
            [2],
            [5],
            ['0'],
            ['1'],
            ['2'],
            ['5'],
            ["Seven 8 nine"],
            ["non:alpha-numeric's"],
            ['someThing8else'],
            ['Буква88'],
            [[]],
        ];
    }
}
