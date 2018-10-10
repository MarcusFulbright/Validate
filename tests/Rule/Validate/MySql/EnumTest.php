<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class EnumTest extends AbstractMysqlStringTest
{
    public function dataProvider(): array
    {
        return [
            [[]],
            [array_fill(0, 65536, 'testValue')]
        ];
    }
}
