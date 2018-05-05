<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class UppercaseTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            ['', true, ''],
            ['a', true, 'A'],
            ['Ab cd', true, 'AB CD'],
            ['ABC DEF', true, 'ABC DEF'],
            ['ж', true, 'Ж'],
            ['АБ ВГ', true, 'АБ ВГ'],
            ['АбвГ ДЕ', true, 'АБВГ ДЕ'],
        ];
    }
}
