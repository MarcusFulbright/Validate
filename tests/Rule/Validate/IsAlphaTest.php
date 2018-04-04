<?php

namespace Nashphp\Validation\Tests\Rule\Validate;

use Nashphp\Validation\Rule\Validate\Alpha;
use PHPUnit\Framework\TestCase;

class IsAlphaTest extends TestCase
{
    public function testIsAlpha()
    {
        $subject = (object) [
            'success' => 'onlyAlphaNumeric',
            'noWhiteSpace' => 'not only alpha numeric',
            'noNumbers' => '123',
        ];

        $rule = new Alpha();

        $successActual = $rule($subject, 'success');
        $this->assertTrue($successActual);

        $noWhiteSpaceActual = $rule($subject, 'noWhiteSpace');
        $this->assertFalse($noWhiteSpaceActual);

        $noNumbersActual = $rule($subject, 'noNumbers');
        $this->assertFalse($noNumbersActual);
    }
}
