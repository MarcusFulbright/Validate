<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class CallbackTest extends AbstractSanitizeTest
{
    protected function getArgs()
    {
        return [
            function ($subject, $field) {
                $value = $subject->$field;
                $subject->$field = (bool) $value;
                return true;
            }
        ];
    }

    public function providerTo()
    {
        return [
            [0, true, false],
            [1, true, true],
        ];
    }
}
