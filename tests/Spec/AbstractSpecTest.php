<?php

namespace Mbright\Validation\Tests\Spec;

use Mbright\Validation\Locator\AbstractLocator;
use Mbright\Validation\Spec\AbstractSpec;
use PHPUnit\Framework\TestCase;

class AbstractSpecTest extends TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

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

    public function testGetArgs()
    {
        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('fakeField', $locator);

        $expected = ['fakeArgs' => 'fake'];
        $spec->addArgs($expected);
        $actual = $spec->getArgs();

        $this->assertEquals($expected, $actual);
    }

    public function testGetName()
    {
        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('fakeField', $locator);

        $expected = 'fakeName';
        $spec->addRuleName($expected);
        $actual = $spec->getRuleName();

        $this->assertEquals($expected, $actual);
    }

    public function testGetDefaultMessage()
    {
        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('fakeField', $locator);

        $spec->addRuleName('fakeRule');
        $spec->addArgs(['fakeArgs' => 'arg']);

        $expected = 'fakeRule(arg)';
        $actual = $spec->getMessage();

        $this->assertEquals($expected, $actual);
    }

    public function testInvoke()
    {
        $fakeField = 'fakeField';
        $fakeArgs = ['fakeArgs' => 'arg'];
        $fakeSubject = (object) [];
        $fakeRule = function ($subject, $field, ...$args) use ($fakeSubject, $fakeArgs, $fakeField) {
            return $subject === $fakeSubject && $fakeField === $field && array_values($fakeArgs) === $args;
        };

        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec($fakeField, $locator);

        $spec->addArgs($fakeArgs);
        $spec->addRuleMock($fakeRule);

        $actual = $spec($fakeSubject);

        $this->assertTrue($actual);
    }
    
    public function testSetRule()
    {
        $fakeCallable = function () {
            return;
        };
        $fakeRuleName = 'fakeRuleName';
        $locator = \Mockery::mock(AbstractLocator::class);
        $locator->shouldReceive('get')->withArgs([$fakeRuleName])->andReturn($fakeCallable);
        $spec = new DummySpec('fakeField', $locator);

        $actual = $spec->setRule($fakeRuleName);

        $this->assertSame($spec, $actual);
        $this->assertEquals($fakeRuleName, $spec->getRuleName());
    }

    public function testSubjectFieldIsBlankRespectsWhiteList()
    {
        $whiteList = [
            'foo'
        ];

        $subject = (object) [
            'testField' => 'foo'
        ];

        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('testField', $locator);
        $spec->setBlankValues($whiteList);

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }

    public function testUnsetFieldsAreBlank()
    {
        $subject = new \stdClass();

        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('non-existing-field', $locator);

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }

    public function testNullFieldsAreBlank()
    {
        $subject = (object) [
            'nullField' => null
        ];

        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('nullField', $locator);

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }

    public function testNonStringsAreNotBlank()
    {
        $subject = (object) [
            'notBlank' => 0
        ];

        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('notBlank', $locator);

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertFalse($actual);
    }

    public function testStringsThatTrimToNothingAreBlank()
    {
        $subject = (object) [
            'shouldBeBlank' => '  '
        ];

        $locator = \Mockery::mock(AbstractLocator::class);
        $spec = new DummySpec('shouldBeBlank', $locator);

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }
}
