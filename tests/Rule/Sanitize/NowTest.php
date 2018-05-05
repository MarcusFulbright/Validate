<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class NowTest extends AbstractSanitizeTest
{
    protected $format = 'Y-m-d';

    protected function getArgs()
    {
        $args = parent::getArgs();
        $args[] = $this->format;
        return $args;
    }

    public function providerTo()
    {
        $now = date('Y-m-d');
        return [
            [0,         true, $now],
            [1,         true, $now],
            ['1',       true, $now],
            [true,      true, $now],
            [false,     true, $now],
        ];
    }
}
