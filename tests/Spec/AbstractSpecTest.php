<?php

namespace Nashphp\Validation\Tests\Spec;

use Nashphp\Validation\Locator\AbstractLocator;
use Nashphp\Validation\Spec\AbstractSpec;
use PHPUnit\Framework\TestCase;

class AbstractSpecTest extends TestCase
{
    public function testSetMessage()
    {
        $expectedMessage = 'fake expected message';
        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('fakeField', $locator);

        $actual = $spec->setMessage($expectedMessage);

        $this->assertInstanceOf(AbstractSpec::class, $actual);
        $this->assertEquals($expectedMessage, $spec->getMessage());
    }

    public function testGetField()
    {
        $expectedField = 'expectedField';
        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec($expectedField, $locator);

        $actual = $spec->getField();

        $this->assertEquals($expectedField, $actual);
    }
}