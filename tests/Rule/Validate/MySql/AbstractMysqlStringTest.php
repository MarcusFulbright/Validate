<?php

namespace Mbright\Validation\Tests\Rule\Validate\MySql;

use PHPUnit\Framework\TestCase;

abstract class AbstractMysqlStringTest extends TestCase
{
    abstract public function dataProvider(): array;

    protected function getClass()
    {
        $testClass = substr(get_class($this), 0, -4);
        return str_replace('Tests\\', '', $testClass);
    }

    protected function newRule($len)
    {
        $class = $this->getClass();
        $rule = new $class($len);

        return $rule;
    }

    /**
     * @dataProvider dataProvider
     *
     * @param int $len
     */
    public function testInvalidLengthsThrowException($len)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->newRule($len);
    }
}
