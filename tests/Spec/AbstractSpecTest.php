<?php

namespace Mbright\Validation\Tests\Spec;

use Mbright\Validation\Spec\AbstractSpec;
use Mbright\Validation\Tests\Examples\ExampleCustomValidateRule;
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
        $spec = new DummySpec('fakeField');

        $actual = $spec->setMessage($expectedMessage);

        $this->assertInstanceOf(AbstractSpec::class, $actual);
        $this->assertEquals($expectedMessage, $spec->getMessage());
    }

    public function testGetField()
    {
        $expectedField = 'expectedField';
        $spec = new DummySpec($expectedField);

        $actual = $spec->getField();

        $this->assertEquals($expectedField, $actual);
    }

    public function testGetArgs()
    {
        $spec = new DummySpec('fakeField');

        $expected = ['fakeArgs' => 'fake'];
        $spec->addArgs($expected);
        $actual = $spec->getArgs();

        $this->assertEquals($expected, $actual);
    }

    public function testGetName()
    {
        $spec = new DummySpec('fakeField');

        $expected = 'fakeName';
        $spec->addRuleName($expected);
        $actual = $spec->getRuleClass();

        $this->assertEquals($expected, $actual);
    }

    public function testGetDefaultMessage()
    {
        $spec = new DummySpec('fakeField');

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

        $spec = new DummySpec($fakeField);

        $spec->addArgs($fakeArgs);
        $spec->addRuleMock($fakeRule);

        $actual = $spec($fakeSubject);

        $this->assertTrue($actual);
    }
    
    public function testSubjectFieldIsBlankRespectsWhiteList()
    {
        $whiteList = [
            'foo'
        ];

        $subject = (object) [
            'testField' => 'foo'
        ];

        $spec = new DummySpec('testField');
        $spec->setBlankValues($whiteList);

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }

    public function testUnsetFieldsAreBlank()
    {
        $subject = new \stdClass();

        $spec = new DummySpec('non-existing-field');

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }

    public function testNullFieldsAreBlank()
    {
        $subject = (object) [
            'nullField' => null
        ];

        $spec = new DummySpec('nullField');

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }

    public function testNonStringsAreNotBlank()
    {
        $subject = (object) [
            'notBlank' => 0
        ];

        $spec = new DummySpec('notBlank');

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertFalse($actual);
    }

    public function testStringsThatTrimToNothingAreBlank()
    {
        $subject = (object) [
            'shouldBeBlank' => '  '
        ];

        $spec = new DummySpec('shouldBeBlank');

        $actual = $spec->subjectFieldIsBlank($subject);

        $this->assertTrue($actual);
    }
}
