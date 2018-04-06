<?php

namespace Nashphp\Validation\Tests;

use Nashphp\Validation\Validator;
use Nashphp\Validation\ValidatorFactory;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /** @var Validator */
    protected $validator;

    protected function setUp()
    {
        $validatorFactory = new ValidatorFactory();

        $this->validator = $validatorFactory->newValidator();
    }

    public function testValidateFailure()
    {
        $expectedMessages = [
            'testField' => [
                'testField did not pass bool()'
            ]
        ];
        $subject = (object) ['testField' => 1];

        $this->validator->validate('testField')->is('bool');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures());
        $this->assertEquals($expectedMessages, $this->validator->getFailures()->getMessages());
    }

    public function testBlankFailureMessage()
    {
        $expectedMessage = [
            'testField' => [
                'testField should not be blank'
            ]
        ];
        $subject = (object) [];

        $this->validator->validate('testField')->is('bool');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures());
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }
}
