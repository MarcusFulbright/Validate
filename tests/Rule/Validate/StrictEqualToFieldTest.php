<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use Mbright\Validation\Rule\Validate\StrictEqualToField;

class StrictEqualToFieldTest extends AbstractValidateTest
{
    protected $other_field = 'other';

    protected $other_value = '1';

    protected function getSubject($value)
    {
        $subject = parent::getSubject($value);
        $subject->{$this->other_field} = $this->other_value;
        return $subject;
    }

    protected function getArgs()
    {
        $args = parent::getArgs();
        $args[] = 'other';
        return $args;
    }

    public function providerIs()
    {
        return [
            ['1'],
        ];
    }

    public function providerIsNot()
    {
        return [
            [1],
            [true],
            [1.00],
        ];
    }

    public function testIsFieldNotSet()
    {
        $subject = (object) ['foo' => '1'];
        $rule = $this->newRule();
        $this->assertFalse($rule->__invoke($subject, 'foo', 'no_such_field'));
    }
}
