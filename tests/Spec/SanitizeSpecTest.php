<?php

namespace Mbright\Validation\Tests\Spec;

use Mbright\Validation\Spec\SanitizeSpec;
use Mbright\Validation\Tests\Examples\ExampleCustomSanitizeRule;
use PHPUnit\Framework\TestCase;

class SanitizeSpecTest extends TestCase
{
    /** @var SanitizeSpec */
    private $spec;

    public function setUp()
    {
        $this->spec = new SanitizeSpec('testField');
    }

    public function testTo()
    {
        $actual = $this->spec->to(ExampleCustomSanitizeRule::class);

        $this->assertSame($this->spec, $actual);
    }

    public function testUsingBlank()
    {
        $actual = $this->spec->usingBlank(null);

        $this->assertSame($this->spec, $actual);
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
