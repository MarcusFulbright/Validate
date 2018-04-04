<?php

namespace Nashphp\Validation\Tests\Rule\Validate;

use Nashphp\Validation\Rule\Validate\AlphaDash;
use PHPUnit\Framework\TestCase;

class IsAlphaDashTest extends TestCase
{
    public function testIsAlphaDash()
    {
        $subject = (object) [
            'success' => '3this_is-acceptable1',
            'allowsNumbers' => 123,
            'noWhiteSpace' => '2this is not_accept-able'
        ];
        $rule = new AlphaDash();

        $successActual = $rule($subject, 'success');
        $this->assertTrue($successActual);

        $allowsNumbersActual = $rule($subject, 'allowsNumbers');
        $this->assertTrue($allowsNumbersActual);

        $noWhiteSpaceActual = $rule($subject, 'noWhiteSpace');
        $this->assertFalse($noWhiteSpaceActual);
    }
}
