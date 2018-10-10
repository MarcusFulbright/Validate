<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class TinyBlobTest extends AbstractMysqlStringTest
{
    public function dataProvider(): array
    {
        return [
            [-1],
            [pow(2, 9)]
        ];
    }
}
