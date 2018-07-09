<?php

namespace Mbright\Validation\Tests\Failure;

use Mbright\Validation\Failure\ValidationFailure;
use Mbright\Validation\Tests\Examples\ExampleCustomValidateRule;
use PHPUnit\Framework\TestCase;
use Mbright\Validation\Failure\FailureCollection;

class FailureCollectionTest extends TestCase
{
    /** @var FailureCollection */
    private $collection;

    public function setUp()
    {
        $this->collection = new FailureCollection();
    }

    public function testIsEmpty()
    {
        $this->assertTrue($this->collection->isEmpty());

        $this->collection->set('fakeField', 'fakeMessage');

        $this->assertFalse($this->collection->isEmpty());
    }

    public function testSet()
    {
        $fakeField = 'fakeField';
        $fakeMessage = 'fakeMessage';
        $this->collection->set($fakeField, $fakeMessage);

        $expected = $this->collection->forField($fakeField);

        $this->assertCount(1, $expected);
        $this->assertInstanceOf(ValidationFailure::class, $expected[0]);
    }

    public function testAdd()
    {
        $fakeField = 'fakeField';
        $fakeMessage = 'fakeMessage';
        $actual = $this->collection->add($fakeField, $fakeMessage, ExampleCustomValidateRule::class);

        $this->assertCount(1, $this->collection);
        $this->assertInstanceOf(ValidationFailure::class, $actual);
    }

    public function testGetMessagesAsString()
    {
        $fakeField1 = 'fakeField1';
        $fakeMessage1 = 'fakeMessage1';
        $fakeField2 = 'fakeField2';
        $fakeMessage2 = 'fakeMessage2';
        $this->collection->add($fakeField1, $fakeMessage1, ExampleCustomValidateRule::class);
        $this->collection->add($fakeField2, $fakeMessage2, ExampleCustomValidateRule::class);

        $expected = "$fakeField1: $fakeMessage1\n$fakeField2: $fakeMessage2\n";
        $actual = $this->collection->getMessagesAsString();
        $this->assertEquals($expected, $actual);
    }

    public function testGetMessagesForFieldAsString()
    {
        $fakeField1 = 'fakeField1';
        $fakeMessage1 = 'fakeMessage1';
        $fakeField2 = 'fakeField2';
        $fakeMessage2 = 'fakeMessage2';
        $this->collection->add($fakeField1, $fakeMessage1, ExampleCustomValidateRule::class);
        $this->collection->add($fakeField2, $fakeMessage2, ExampleCustomValidateRule::class);

        $expected = "$fakeMessage1\n";
        $actual = $this->collection->getMessagesForFieldAsString($fakeField1);

        $this->assertEquals($expected, $actual);
    }

    public function testGetMessages()
    {
        $fakeField1 = 'fakeField1';
        $fakeMessage1 = 'fakeMessage1';
        $fakeField2 = 'fakeField2';
        $fakeMessage2 = 'fakeMessage2';
        $this->collection->add($fakeField1, $fakeMessage1, ExampleCustomValidateRule::class);
        $this->collection->add($fakeField2, $fakeMessage2, ExampleCustomValidateRule::class);

        $expected = [
            $fakeField1 => [$fakeMessage1],
            $fakeField2 => [$fakeMessage2]
        ];
        $actual = $this->collection->getMessages();

        $this->assertEquals($expected, $actual);
    }

    public function testGetMessagesForFieldReturnsBlank()
    {
        $actual = $this->collection->getMessagesForField('fakeField');

        $this->assertTrue(is_array($actual));
        $this->assertEmpty($actual);
    }

    public function testForFieldReturnsBlank()
    {
        $actual = $this->collection->forField('fakeField');

        $this->assertTrue(is_array($actual));
        $this->assertEmpty($actual);
    }
}
