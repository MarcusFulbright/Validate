<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class LowerCaseFirstTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            ['', true, ''],
            ['A', true, 'a'],
            ['AbCd', true, 'abCd'],
            ['ABCDEF', true, 'aBCDEF'],
            ['Ж', true, 'ж'],
            ['АБВГ', true, 'аБВГ'],
            ['АБВГДЕ', true, 'аБВГДЕ'],
        ];
    }
}
