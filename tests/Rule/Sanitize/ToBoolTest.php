<?php

namespace Nashphp\Validation\Tests\Rule\Sanitize;

use Nashphp\Validation\Rule\Sanitize\ToBool;
use PHPUnit\Framework\TestCase;

class ToBoolTest extends TestCase
{
    public function testToBool()
    {
        $subject = (object) [
            'castToBool' => '1',
        ];
        $rule = new ToBool();

        $rule($subject, 'castToBool');

        $this->assertEquals(true, $subject->castToBool);
    }
}
