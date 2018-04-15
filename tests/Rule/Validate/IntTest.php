<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use Mbright\Validation\Rule\Validate\Integer;
use PHPUnit\Framework\TestCase;

class IntTest extends TestCase
{
    public function testInt()
    {
        $subject = (object) [
            'valid' => 1,
            'invalid' => '1'
        ];
        $rule = new Integer();

        $validActual = $rule($subject, 'valid');
        $this->assertTrue($validActual);

        $invalidActual = $rule($subject, 'invalid');
        $this->assertFalse($invalidActual);
    }
}
