<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class RegexTest extends AbstractSanitizeTest
{
    protected $expr_sanitize = '/[^a-z]/';

    protected function getArgs()
    {
        return [$this->expr_sanitize, '@'];
    }

    public function providerTo()
    {
        return [
            [[], false, []],
            ['abc 123 ,./', true, 'abc@@@@@@@@'],
        ];
    }
}
