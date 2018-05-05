<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class BooleanTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            [true],
            ['on'],
            ['On'],
            ['ON'],
            ['yes'],
            ['Yes'],
            ['YeS'],
            ['y'],
            ['Y'],
            ['true'],
            ['True'],
            ['TrUe'],
            ['t'],
            ['T'],
            [1],
            ['1'],
            [false],
            ['off'],
            ['Off'],
            ['OfF'],
            ['no'],
            ['No'],
            ['NO'],
            ['n'],
            ['N'],
            ['false'],
            ['False'],
            ['FaLsE'],
            ['f'],
            ['F'],
            [0],
            ['0'],
        ];
    }

    public function providerIsNot()
    {
        return [
            ['nothing'],
            [123],
            [[1]],
        ];
    }
}
