<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

class TinyIntTest extends AbstractMySqlIntegerTest
{
    public function providerSignedIs(): array
    {
        return [
            [-128],
            [127],
            [0],
        ];
    }

    public function providerSignedIsNot(): array
    {
        return [
            [-129],
            [128],
        ];
    }

    public function providerUnsignedIs(): array
    {
        return [
            [255],
            [0],
            [126],
        ];
    }

    public function providerUnsignedIsNot(): array
    {
        return [
            [-1],
            [256],
        ];
    }
}
