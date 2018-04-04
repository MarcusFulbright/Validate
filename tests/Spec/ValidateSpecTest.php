<?php

namespace Nashphp\Validation\Tests\Spec;

use Mockery\MockInterface;
use Nashphp\Validation\Locator\AbstractLocator;
use Nashphp\Validation\Spec\ValidateSpec;
use PHPUnit\Framework\TestCase;

class ValidateSpecTest extends TestCase
{
    /** @var MockInterface */
    private $locator;

    /** @var ValidateSpec */
    private $spec;

    public function setUp()
    {
        $this->locator = \Mockery::mock(AbstractLocator::class);
        $this->spec = new ValidateSpec('testField', $this->locator);
    }

    public function testIs()
    {
        $fakeCallable = function () {
            return;
        };
        $this->locator->shouldReceive('get')->withArgs(['fakeRule'])->andReturn($fakeCallable);

        $actual = $this->spec->is('fakeRule', []);

        $this->assertSame($this->spec, $actual);
    }

    public function testIsNot()
    {
        $fakeCallable = function () {
            return;
        };
        $this->locator->shouldReceive('get')->withArgs(['fakeRule'])->andReturn($fakeCallable);

        $actual = $this->spec->isNot('fakeRule', []);

        $this->assertSame($this->spec, $actual);
    }

    public function testAllowBlank()
    {
        $actual = $this->spec->allowBlank();

        $this->assertSame($this->spec, $actual);
    }

    public function testSetBlankValues()
    {
        $blankValues = [];

        $actual = $this->spec->setBlankValues($blankValues);

        $this->assertSame($this->spec, $actual);
    }
}
