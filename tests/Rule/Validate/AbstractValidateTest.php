<?php

namespace Mbright\Validation\Tests\Rule\Validate;

use PHPUnit\Framework\TestCase;

abstract class AbstractValidateTest extends TestCase
{
    /**
     * DataProvider method used to return all values that should validate as true.
     *
     * @return array
     */
    abstract public function providerIs();

    /**
     * DataProvider method used to return all values that should validate as false.
     *
     * @return array
     */
    abstract public function providerIsNot();


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

        return call_user_func_array($rule, $args);
    }

    /**
     * @dataProvider providerIs
     */
    public function testIs($value)
    {
        $this->assertTrue($this->invoke($value));
    }

    /**
     * @dataProvider providerIsNot
     */
    public function testIsNot($value)
    {
        $this->assertFalse($this->invoke($value));
    }
}
