<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class StrTest extends AbstractSanitizeTest
{
    protected $find = ' ';
    protected $repl = '@';

    protected function getArgs()
    {
        return [$this->find, $this->repl];
    }

    public function providerTo()
    {
        return [
            ['abc 123 ,./', true, 'abc@123@,./'],
            ['abc 123 ,./ абв', true, 'abc@123@,./@абв'],
            [12345, true, '12345'],
        ];
    }
}
