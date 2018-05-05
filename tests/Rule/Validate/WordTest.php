<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class WordTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['abc'],
            ['def'],
            ['ghi'],
            ['abc_def'],
            ['A1s_2Sd'],
            ['хмA1s_2Sd_дума'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [''],
            ['a!'],
            ['^b'],
            ['%'],
            ['ab-db cd-ef'],
            ['тест-тест']
        ];
    }
}
