<?php

namespace Nashphp\Validation\Tests\Spec;

use Nashphp\Validation\Rule\Sanitize\ToBool;
use Nashphp\Validation\Spec\AbstractSpec;
use Nashphp\Validation\Tests\DummyRule;
use PHPUnit\Framework\TestCase;

class AbstractSpecTest extends TestCase
{
    public function testInvoke()
    {
        $subject = (object) [
            'testField' => true
        ];
        $rule = new ToBool();
        $spec = new DummySpec('testField', $rule, 'ruleName', []);
        $actual = $spec($subject);

        $this->assertTrue($actual);
    }

    public function testSetMessage()
    {
        $expectedMessage = 'fake expected message';
        $fakeRule = function () {
            return true;
        };
        $spec = new DummySpec('fakeField', $fakeRule, 'fakeField', []);

        $actual = $spec->setMessage($expectedMessage);

        $this->assertInstanceOf(AbstractSpec::class, $actual);
        $this->assertEquals($expectedMessage, $spec->getMessage());
    }

    public function testGetField()
    {
        $expectedField = 'expectedField';
        $fakeRule = function () {
            return true;
        };
        $spec = new DummySpec($expectedField, $fakeRule, 'fakeRuleName', []);

        $actual = $spec->getField();

        $this->assertEquals($expectedField, $actual);
    }

    public function testGetArgs()
    {
        $expectedArgs = ['fakeArg'];
        $fakeRule = function () {
            return true;
        };
        $spec = new DummySpec('fakeField', $fakeRule, 'fakeRuleName', $expectedArgs);

        $actual = $spec->getArgs();

        $this->assertEquals($expectedArgs, $actual);
    }

    public function testGetRuleName()
    {
        $expectedRuleName = 'expectedRuleName';
        $fakeRule = function () {
            return true;
        };
        $spec = new DummySpec('fakeField', $fakeRule, $expectedRuleName, []);

        $actual = $spec->getRuleName();

        $this->assertEquals($expectedRuleName, $actual);
    }

    public function testGetDefaultMessage()
    {
        $expectedMessage = 'fakeRuleName(test1Value, test2Value)';
        $fakeArgs = [
            'test1' => 'test1Value',
            'test2' => 'test2Value'
        ];
        $fakeRule = function () {
            return true;
        };
        $spec = new DummySpec('fakeField', $fakeRule, 'fakeRuleName', $fakeArgs);

        $actual = $spec->getMessage();

        $this->assertEquals($expectedMessage, $actual);
    }
}
