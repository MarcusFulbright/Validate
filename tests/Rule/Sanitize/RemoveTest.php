<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

use Mbright\Validation\Rule\Sanitize\Remove;
use PHPUnit\Framework\TestCase;

class RemoveTest extends TestCase
{
    public function testTo()
    {
        $subject = (object) [
            'foo' => 'bar',
            'baz' => 'dib',
        ];

        $rule = new Remove();
        $rule->__invoke($subject, 'foo');

        $expect = (object) [
            'baz' => 'dib',
        ];

        $this->assertEquals($expect, $subject);
    }
}
