<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class MediumBlobTest extends AbstractMysqlStringTest
{
    public function dataProvider(): array
    {
        return [
            [-1],
            [pow(2, 25)],
        ];
    }
}
