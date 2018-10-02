<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use PHPUnit\Framework\TestCase;

abstract class AbstractMySqlIntegerTest extends TestCase
{
    abstract public function providerSignedIs(): array;

    abstract public function providerSignedIsNot(): array;

    abstract public function providerUnsignedIs(): array;

    abstract public function providerUnsignedIsNot(): array;

    protected function getClass()
    {
        $testClass = substr(get_class($this), 0, -4);
        return str_replace('Tests\\', '', $testClass);
    }

    protected function newRule($signed = true)
    {
        $class = $this->getClass();
        $rule = new $class($signed);

        return $rule;
    }

    protected function getSubject($value)
    {
        return (object) ['foo' => $value];
    }

    protected function invoke($value, $signed = true)
    {
        $subject = $this->getSubject($value);
        $field = 'foo';
        $args = [$subject, $field];
        $rule = $this->newRule($signed);

        return call_user_func_array($rule, $args);
    }

    /**
     * @dataProvider providerSignedIs
     */
    public function testSignedIs($value)
    {
        $this->assertTrue($this->invoke($value));
    }

    /**
     * @dataProvider providerSignedIsNot
     */
    public function testSignedIsNot($value)
    {
        $this->assertFalse($this->invoke($value));
    }

    /**
     * @dataProvider providerUnsignedIs
     */
    public function testUnsignedIs($value)
    {
        $this->assertTrue($this->invoke($value, false));
    }

    /**
     * @dataProvider providerUnsignedIsNot
     */
    public function testUnsignedIsNot($value)
    {
        $this->assertFalse($this->invoke($value, false));
    }
}
