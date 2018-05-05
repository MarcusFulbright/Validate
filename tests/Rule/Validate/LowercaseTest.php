<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class LowercaseTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['abcd'],
            ['efgh'],
            ['абвв'],
            ['фгег'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['aBcd'],
            ['Efgh'],
            ['АБВВ'],
            ['ФГег'],
        ];
    }
}
