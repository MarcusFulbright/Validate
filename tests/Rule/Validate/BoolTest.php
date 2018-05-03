<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use Mbright\Validation\Rule\Validate\Boolean;
use PHPUnit\Framework\TestCase;

class BoolTest extends TestCase
{
    public function testIsBool()
    {
        $subject = (object)[
            'isBool' => false,
            'isNotBool' => 'notABool'
        ];
        $rule = new Boolean();

        $expectedTrue = $rule($subject, 'isBool');
        $this->assertTrue($expectedTrue);

        $expectedFalse = $rule($subject, 'isNotBool');
        $this->assertFalse($expectedFalse);
    }
}
