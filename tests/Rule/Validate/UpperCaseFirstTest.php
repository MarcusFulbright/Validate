<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class UpperCaseFirstTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['Ab Cd'],
            ['EFGH'],
            ['АБ ВВ'],
            ['Фг ег'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['aBCD'],
            ['ef GH'],
            ['аб ВВ'],
            ['фГ ЕГ'],
        ];
    }
}
