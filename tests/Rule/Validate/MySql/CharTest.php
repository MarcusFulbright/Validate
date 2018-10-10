<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class CharTest extends AbstractMysqlStringTest
{
    public function dataProvider(): array
    {
        return [
            [-1],
            [256]
        ];
    }
}
