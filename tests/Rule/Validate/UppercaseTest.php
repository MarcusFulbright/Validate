<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class UppercaseTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['AB CD'],
            ['EFGH'],
            ['АБ ВВ'],
            ['ФГ ЕГ'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['aBcD'],
            ['Ef gH'],
            ['Аб ВВ'],
            ['ФГ ег'],
        ];
    }
}
