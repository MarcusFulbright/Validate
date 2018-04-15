<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

use Mbright\Validation\Rule\Sanitize\Integer;
use PHPUnit\Framework\TestCase;

class IntTest extends TestCase
{
    public function testSanitizeToInt()
    {
        $subject = (object) [
            'castToInt' => '1'
        ];
        $rule = new Integer();

        $actual = $rule($subject, 'castToInt');

        $this->assertTrue($actual);
        $this->assertInternalType('int', $subject->castToInt);
    }
}
