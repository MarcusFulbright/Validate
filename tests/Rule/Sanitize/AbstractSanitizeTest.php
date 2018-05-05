<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

use PHPUnit\Framework\TestCase;

abstract class AbstractSanitizeTest extends TestCase
{
    abstract public function providerTo();

    protected function getClass()
    {
        $testClass = substr(get_class($this), 0, -4);

        return str_replace('Tests\\', '', $testClass);
    }

    protected function newRule()
    {
        $class = $this->getClass();
        $rule = new $class();
        return $rule;
    }

    protected function getArgs()
    {
        return [];
    }

    protected function getSubject($value)
    {
        return (object) ['foo' => $value];
    }

    protected function invoke($value)
    {
        $subject = $this->getSubject($value);
        $field = 'foo';
        $args = array_merge(
            [$subject, $field],
            (array) $this->getArgs()
        );
        $rule = $this->newRule();

        return [
            call_user_func_array($rule, $args),
            $subject->$field
        ];
    }

    /**
     * @dataProvider providerTo
     */
    public function testTo($value, $expect_return, $expect_value)
    {
        list($actual_return, $actual_value) = $this->invoke($value);
        $this->assertSame($expect_return, $actual_return);
        $this->assertSame($expect_value, $actual_value);
    }
}
