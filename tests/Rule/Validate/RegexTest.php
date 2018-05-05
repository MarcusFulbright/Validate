<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class RegexTest extends AbstractValidateTest
{
    protected $expr_validate = '/^[\+\-]?[0-9]+$/';

    protected $expr_sanitize = '/[^a-z]/';

    protected function getArgs()
    {
        return [$this->expr_validate];
    }


    public function providerIs()
    {
        return [
            ['+1234567890'],
            [1234567890],
            [-123456789.0],
            [-1234567890],
            ['-123'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [' '],
            [''],
            ['-abc.123'],
            ['123.abc'],
            ['123),456'],
            ['0000123.456000'],
        ];
    }
}
