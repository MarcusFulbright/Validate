<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class CallbackTest extends AbstractValidateTest
{
    protected function getArgs()
    {
        return [
            function ($subject, $field) {
                return is_bool($subject->$field);
            }
        ];
    }

    public function providerIs()
    {
        return [
            [true],
            [false],
        ];
    }

    public function providerIsNot()
    {
        return [
            [0],
            [1],
            [null],
        ];
    }

    public function providerFix()
    {
        return [
            [0, true, false],
            [1, true, true],
        ];
    }
}
