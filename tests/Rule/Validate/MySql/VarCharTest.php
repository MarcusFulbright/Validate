<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class VarCharTest extends AbstractMysqlStringTest
{
    public function dataProvider(): array
    {
        return [
            [-1],
            [65536]
        ];
    }
}
