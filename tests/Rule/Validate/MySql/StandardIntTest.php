<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class StandardIntTest extends AbstractMySqlIntegerTest
{
    public function providerSignedIs(): array
    {
        return [
            [-2147483648],
            [2147483647],
            [0],
            [-9847],
            [48],
        ];
    }

    public function providerSignedIsNot(): array
    {
        return [
            [-2147483649],
            [-3258594750],
            [2147483649],
            [3258594750],
        ];
    }

    public function providerUnsignedIs(): array
    {
        return [
            [4294967295],
            [0],
            [1000],
            [49584958]
        ];
    }

    public function providerUnsignedIsNot(): array
    {
        return [
            [-1],
            [-85849],
            [4294967296],
            [584857493783945]
        ];
    }
}
