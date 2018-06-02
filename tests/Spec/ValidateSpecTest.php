<?php

namespace Mbright\Validation\Tests\Spec;

use Mbright\Validation\Spec\ValidateSpec;
use Mbright\Validation\Tests\Examples\ExampleCustomSanitizeRule;
use Mbright\Validation\Tests\Examples\ExampleCustomValidateRule;
use PHPUnit\Framework\TestCase;

class ValidateSpecTest extends TestCase
{
    /** @var ValidateSpec */
    private $spec;

    public function setUp()
    {
        $this->spec = new ValidateSpec('testField');
    }

    public function testIs()
    {
        $actual = $this->spec->is(ExampleCustomValidateRule::class, []);

        $this->assertSame($this->spec, $actual);
    }

    public function testIsNot()
    {
        $actual = $this->spec->isNot(ExampleCustomValidateRule::class, []);

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

    public function testInvokeAllowBlankValue()
    {
        $subject = new \stdClass();
        $this->spec->allowBlank();

        $actual = ($this->spec)($subject);

        $this->assertTrue($actual);
    }

    public function testInvokeRule()
    {
        $subject = (object) [
            'testField' => 'foo'
        ];

        $this->spec->is(ExampleCustomValidateRule::class, []);

        $actual = ($this->spec)($subject);

        $this->assertTrue($actual);
    }

    public function testInvokeNegated()
    {
        $subject = (object) [
            'testField' => 'foo'
        ];

        $this->spec->isNot(ExampleCustomValidateRule::class, []);

        $actual = ($this->spec)($subject);

        $this->assertFalse($actual);
    }
}
