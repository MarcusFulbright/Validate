<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class SmallIntTest extends AbstractMySqlIntegerTest
{
    public function providerSignedIs(): array
    {
        return [
            [-32768],
            [32767],
            [0]
        ];
    }

    public function providerSignedIsNot(): array
    {
        return [
            [-32769],
            [32768]
        ];
    }

    public function providerUnsignedIs(): array
    {
        return [
            [65535],
            [0]
        ];
    }

    public function providerUnsignedIsNot(): array
    {
        return [
            [-1],
            [65536]
        ];
    }
}
