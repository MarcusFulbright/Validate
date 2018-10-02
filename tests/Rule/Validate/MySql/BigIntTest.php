<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class BigIntTest extends AbstractMySqlIntegerTest
{
    public function providerSignedIs(): array
    {
        return [
            [-pow(2, 63)],
            [pow(2, 63) - 1000],
            [0]
        ];
    }

    public function providerSignedIsNot(): array
    {
        return [
            [-pow(2, 63) - 1030],
            [pow(2, 63)],
        ];
    }

    public function providerUnsignedIs(): array
    {
        return [
            [pow(2, 63) - 1000],
            [0]
        ];
    }

    public function providerUnsignedIsNot(): array
    {
        return [
            [pow(2, 64)],
            [-1]
        ];
    }
}
