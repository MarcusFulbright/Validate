<?php

namespace Nashphp\Validation\Tests\Rule\Sanitize;

use Nashphp\Validation\Rule\Sanitize\Boolean;
use PHPUnit\Framework\TestCase;

class BoolTest extends TestCase
{
    public function testToBool()
    {
        $subject = (object) [
            'castToBool' => '1',
        ];
        $rule = new Boolean();

        $rule($subject, 'castToBool');

        $this->assertEquals(true, $subject->castToBool);
    }
}
