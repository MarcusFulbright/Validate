<?php

namespace Nashphp\Validation\Tests\Examples;

use Nashphp\Validation\ValidatorFactory;

class ValidatorExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testSanitizeToBool()
    {
        $subject = new \stdClass();
        $subject->testField = 1;

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField', 'toBool');
        $validator->apply($subject);

        $this->assertTrue($subject->testField);
    }

    public function testValidateBoolSuccess()
    {
        $subject = new \stdClass();
        $subject->testField = true;

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField', 'isBool');
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testValidateBoolFailure()
    {
        $expectedMessages = [
            'testField' => [
                'testField did not pass isBool(*stdClass*, testField)'
            ]
        ];
        $subject = new \stdClass();
        $subject->testField = 1;

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField', 'isBool');
        $result = $validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $validator->getFailures());
        $this->assertEquals($expectedMessages, $validator->getFailures()->getMessages());
    }
}
