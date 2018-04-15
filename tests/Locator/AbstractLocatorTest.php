<?php

namespace Mbright\Validation\Tests\Locator;

use Mbright\Validation\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class AbstractLocatorTest extends TestCase
{
    /** @var DummyLocator */
    protected $locator;

    public function setUp()
    {
        $this->locator = new DummyLocator();
    }

    public function testGetNotMappedThrowsException()
    {
        $this->expectException(ValidationException::class);
        $this->locator->get('doesNotExist');
    }

    public function testGetWillCreateNewInstance()
    {
        $actual = $this->locator->get('foo');
        $this->assertTrue(is_callable($actual));
    }

    public function testGetWillReUseSameInstance()
    {
        $expected = $this->locator->get('foo');
        $actual = $this->locator->get('foo');

        $this->assertEquals($expected, $actual);
    }
}
