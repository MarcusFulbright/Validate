<?php

namespace Nashphp\Validation\Tests\Examples;

use Nashphp\Validation\ValidatorFactory;
use PHPUnit\Framework\TestCase;

class ValidatorExampleTest extends TestCase
{
    public function testSanitizeToBool()
    {
        $subject = new \stdClass();
        $subject->testField = 1;

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField')->to('bool');
        $validator->apply($subject);

        $this->assertTrue($subject->testField);
    }

    public function testValidateBoolSuccess()
    {
        $subject = new \stdClass();
        $subject->testField = true;

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('bool');
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testValidateBoolFailure()
    {
        $expectedMessages = [
            'testField' => [
                'testField did not pass bool()'
            ]
        ];
        $subject = new \stdClass();
        $subject->testField = 1;

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('bool');
        $result = $validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $validator->getFailures());
        $this->assertEquals($expectedMessages, $validator->getFailures()->getMessages());
    }

    public function testIsBetween()
    {
        $subject = (object) [
            'success' => 5,
        ];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('success')->is('between', 1, 10);
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }
}
