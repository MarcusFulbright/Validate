<?php

namespace Mbright\Validation\Tests\Failure;

use Mbright\Validation\Failure\ValidationFailure;
use PHPUnit\Framework\TestCase;

class ValidationFailureTest extends TestCase
{
    /** @var ValidationFailure */
    private $failure;

    /** @var string */
    private $fakeField = 'fakeField';

    /** @var string */
    private $fakeMessage = 'fakeMessage';

    /** @var array */
    private $fakeArgs = ['fakeArg' => 'fakeArg'];

    public function setUp()
    {
        $this->failure = new ValidationFailure($this->fakeField, $this->fakeMessage, $this->fakeArgs);
    }


    public function testGetField()
    {
        $actual = $this->failure->getField();

        $this->assertEquals($this->fakeField, $actual);
    }

    public function testGetMessage()
    {
        $actual = $this->failure->getMessage();

        $this->assertEquals($this->fakeMessage, $actual);
    }

    public function testGetArgs()
    {
        $actual = $this->failure->getArgs();

        $this->assertEquals($this->fakeArgs, $actual);
    }

    public function testJsonSerialize()
    {
        $expected = json_encode([
            'field' => $this->fakeField,
            'message' => $this->fakeMessage,
            'args' => $this->fakeArgs
        ]);
        $actual = json_encode($this->failure);

        $this->assertEquals($expected, $actual);
    }
}
