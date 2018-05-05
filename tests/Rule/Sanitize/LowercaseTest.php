<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class LowercaseTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            ['', true, ''],
            ['A', true, 'a'],
            ['AbCd', true, 'abcd'],
            ['ABCDEF', true, 'abcdef'],
            ['Ж', true, 'ж'],
            ['АБВГ', true, 'абвг'],
            ['АБВГДЕ', true, 'абвгде'],
        ];
    }
}
