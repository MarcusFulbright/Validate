<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class AlphaDashTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['alphaOnly'],
            ['alphaNum123'],
            ['_'],
            ['-'],
            ['1'],
            ['alpha_Num_Dash-1']
        ];
    }

    public function providerIsNot()
    {
        return [
            ['no white space'],
            [(object)[]],
            [[]]
        ];
    }
}
