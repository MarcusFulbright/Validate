<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use Mbright\Validation\Rule\Validate\EqualToField;

class EqualToFieldTest extends AbstractValidateTest
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
            [1],
            ['1'],
            [true],
        ];
    }

    public function providerIsNot()
    {
        return [
            [0],
            ['2'],
            [false],
        ];
    }

    public function testIsFieldNotSet()
    {
        $subject = (object) ['foo' => '1'];

        $rule = $this->newRule();

        $this->assertFalse($rule->__invoke($subject, 'foo', 'no_such_field'));
    }
}
