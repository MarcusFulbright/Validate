<?php

namespace Nashphp\Validation\Tests\Rule\Validate;

use Nashphp\Validation\Rule\Validate\IsBool;
use PHPUnit\Framework\TestCase;

class IsBoolTest extends TestCase
{
    public function testIsBool()
    {
        $subject = (object)[
            'isBool' => false,
            'isNotBool' => 'false'
        ];
        $rule = new IsBool();

        $expectedTrue = $rule($subject, 'isBool');
        $this->assertTrue($expectedTrue);

        $expectedFalse = $rule($subject, 'isNotBool');
        $this->assertFalse($expectedFalse);
    }
}
