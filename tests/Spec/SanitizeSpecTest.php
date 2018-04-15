<?php

namespace Mbright\Validation\Tests\Spec;

use Mockery\MockInterface;
use Mbright\Validation\Locator\AbstractLocator;
use Mbright\Validation\Spec\SanitizeSpec;
use PHPUnit\Framework\TestCase;

class SanitizeSpecTest extends TestCase
{
    /** @var MockInterface */
    private $locator;

    /** @var SanitizeSpec */
    private $spec;

    public function setUp()
    {
        $this->locator = \Mockery::mock(AbstractLocator::class);
        $this->spec = new SanitizeSpec('testField', $this->locator);
    }

    public function testTo()
    {
        $fakeRuleName = 'fakeRuleName';
        $fakeCallable = function () {
            return;
        };

        $this->locator->shouldReceive('get')->withArgs([$fakeRuleName])->andReturn($fakeCallable);

        $actual = $this->spec->to($fakeRuleName);

        $this->assertSame($this->spec, $actual);
    }

    public function testUsingBlank()
    {
        $actual = $this->spec->usingBlank(null);

        $this->assertSame($this->spec, $actual);
    }

    public function testToManipulatesObject()
    {
        $subject =(object) [
            'testField' => 'bar'
        ];
        $rule = function ($subject) {
            $subject->testField = 'foo';

            return true;
        };

        $this->locator->shouldReceive('get')->withArgs(['foo'])->andReturn($rule);

        $this->spec->to('foo');

        $actual = ($this->spec)($subject);

        $this->assertTrue($actual);
        $this->assertEquals('foo', $subject->testField);
    }

    public function testPreventBlank()
    {
        $subject = new \stdClass();

        $actual = ($this->spec)($subject);

        $this->assertFalse($actual);
    }

    public function testUsesBlankValue()
    {
        $subject = new \stdClass();

        $this->spec->usingBlank('foo');

        $actual = ($this->spec)($subject);

        $this->assertTrue($actual);
        $this->assertEquals('foo', $subject->testField);
    }
}
