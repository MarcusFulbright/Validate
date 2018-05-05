<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class UppercaseFirstTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            ['', true, ''],
            ['a', true, 'A'],
            ['Ab cd', true, 'Ab cd'],
            ['ABC DEF', true, 'ABC DEF'],
            ['ж', true, 'Ж'],
            ['аб вг', true, 'Аб вг'],
            ['АбвГ ДЕ', true, 'АбвГ ДЕ'],
        ];
    }
}
