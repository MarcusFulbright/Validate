<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class TitleCaseTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            [[], false, []],
            ['A', true, 'A'],
            ['Ab cd', true, 'Ab Cd'],
            ['ABC DEF', true, 'Abc Def'],
            ['Ж', true, 'Ж'],
            ['АБ ВГ', true, 'Аб Вг'],
            ['АбвГ ДЕ', true, 'Абвг Де'],
        ];
    }
}
