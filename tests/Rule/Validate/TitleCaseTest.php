<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class TitleCaseTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['Ab Cd'],
            ['Efgh'],
            ['Аб Вв'],
            ['Фг Ег'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            ['aBcd'],
            ['Ef gH'],
            ['АБ ВВ'],
            ['ФГ ег'],
        ];
    }
}
