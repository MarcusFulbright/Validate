<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class LowercaseFirstTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['ab Cd'],
            ['eFGH'],
            ['аБ ВВ'],
            ['фг ег'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['ABCD'],
            ['Ef gH'],
            ['Аб вВ'],
            ['Фг ег'],
        ];
    }
}
