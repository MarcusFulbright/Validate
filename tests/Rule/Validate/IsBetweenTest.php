<?php

namespace Nashphp\Validation\Tests\Rule\Validate;

use Nashphp\Validation\Rule\Validate\IsBetween;
use PHPUnit\Framework\TestCase;

class IsBetweenTest extends TestCase
{
    public function testIsBetween()
    {
        $subject = (object)[
            'intSuccess' => 5,
            'stringSuccess' => 'string',
            'intFailure' => 0,
            'stringFailure' => 'short'
        ];
        $rule = new IsBetween();

        $intSuccessActual = $rule($subject, 'intSuccess', 4, 6);
        $this->assertTrue($intSuccessActual);

        $stringSuccess = $rule($subject, 'stringSuccess', 0, 10);
        $this->assertTrue($stringSuccess);

        $intFailure = $rule($subject, 'intFailure', 4, 5);
        $this->assertFalse($intFailure);

        $stringFailure = $rule($subject, 'stringFailure', 10, 20);
        $this->assertFalse($stringFailure);
    }
}
