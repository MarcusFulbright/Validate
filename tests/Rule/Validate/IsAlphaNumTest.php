<?php

namespace Nashphp\Validation\Tests\Rule\Validate;

use Nashphp\Validation\Rule\Validate\IsAlphaNum;
use PHPUnit\Framework\TestCase;

class IsAlphaNumTest extends TestCase
{
    public function testIsAlphaNum()
    {
        $subject = (object)[
            'success' => 'onlyAlphaNum123',
            'acceptsIntegers' => 12345,
            'noWhiteSpace' => 'only Alpha Num 123',
            'noOthertypes' => false
        ];
        $rule = new IsAlphaNum();

        $successActual = $rule($subject, 'success');
        $this->assertTrue($successActual);

        $acceptsIntegersActual = $rule($subject, 'acceptsIntegers');
        $this->assertTrue($acceptsIntegersActual);

        $noWhiteSpaceActual = $rule($subject, 'noWhiteSpace');
        $this->assertFalse($noWhiteSpaceActual);

        $noOtherTypesActual = $rule($subject, 'noOthertypes');
        $this->assertFalse($noOtherTypesActual);
    }
}
