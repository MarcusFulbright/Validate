<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class UppercaseFirstTest extends AbstractValidateTest
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
