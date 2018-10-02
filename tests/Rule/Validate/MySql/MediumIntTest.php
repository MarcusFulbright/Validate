<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class MediumIntTest extends AbstractMySqlIntegerTest
{
    public function providerSignedIs(): array
    {
        return [
            [-8388608],
            [8388607],
            [0],
            [104830],
            [-4389483]
        ];
    }

    public function providerSignedIsNot(): array
    {
        return [
            [-8388609],
            [8388608],
            [-589494849],
            [484309348590],
        ];
    }

    public function providerUnsignedIs(): array
    {
        return [
            [16777215],
            [0],
            [404859]
        ];
    }

    public function providerUnsignedIsNot(): array
    {
        return [
            [-1],
            [-485948],
            [16777216],
            [4048959484453]
        ];
    }
}
