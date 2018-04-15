<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use Mbright\Validation\Rule\Validate\Between;
use PHPUnit\Framework\TestCase;

class BetweenTest extends TestCase
{
    public function testIsBetween()
    {
        $subject = (object)[
            'intSuccess' => 5,
            'stringSuccess' => 'string',
            'intFailure' => 0,
            'stringFailure' => 'short',
            'excludesWrongType' => []
        ];
        $rule = new Between();

        $intSuccessActual = $rule($subject, 'intSuccess', 4, 6);
        $this->assertTrue($intSuccessActual);

        $stringSuccess = $rule($subject, 'stringSuccess', 0, 10);
        $this->assertTrue($stringSuccess);

        $intFailure = $rule($subject, 'intFailure', 4, 5);
        $this->assertFalse($intFailure);

        $stringFailure = $rule($subject, 'stringFailure', 10, 20);
        $this->assertFalse($stringFailure);

        $wrongTypeFailure = $rule($subject, 'excludesWrongType', 1, 10);
        $this->assertFalse($wrongTypeFailure);
    }
}
