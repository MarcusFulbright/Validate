<?php

namespace Nashphp\Validation\Tests\Rule\Validate;

use Nashphp\Validation\Rule\Validate\Boolean;
use PHPUnit\Framework\TestCase;

class IsBoolTest extends TestCase
{
    public function testIsBool()
    {
        $subject = (object)[
            'isBool' => false,
            'isNotBool' => 'false'
        ];
        $rule = new Boolean();

        $expectedTrue = $rule($subject, 'isBool');
        $this->assertTrue($expectedTrue);

        $expectedFalse = $rule($subject, 'isNotBool');
        $this->assertFalse($expectedFalse);
    }
}
