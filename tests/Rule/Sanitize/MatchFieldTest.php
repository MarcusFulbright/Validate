<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class MatchFieldTest extends AbstractSanitizeTest
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

    public function providerTo()
    {
        return [
            [0,         true, '1'],
            [1,         true, '1'],
            ['1',       true, '1'],
            [true,      true, '1'],
            [false,     true, '1'],
        ];
    }

    public function testToFieldNotSet()
    {
        $subject = (object) ['foo' => '1'];
        $class = $this->getClass();
        $rule = new $class();
        $this->assertFalse($rule->__invoke($subject, 'foo', 'no_such_field'));
    }
}
