<?php

namespace Nashphp\Validation\Tests\Examples;

use Nashphp\Validation\ValidatorFactory;
use PHPUnit\Framework\TestCase;

/**
 * @group Examples
 */
class ValidatorExampleTest extends TestCase
{
    public function testSanitizeToBool()
    {
        $subject = (object) ['testField' => 1];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField')->to('bool');
        $validator->apply($subject);

        $this->assertTrue($subject->testField);
    }

    public function testSanitizeArray()
    {
        $subject = ['testField' => 1];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField')->to('bool');
        $validator->apply($subject);

        $this->assertTrue($subject['testField']);
    }

    public function testSanitizeWithBlankValue()
    {
        $expectedBlank = 'expectedBlankValue';
        $subject = (object) ['testField' => ''];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField')->to('bool')->usingBlank($expectedBlank);
        $result = $validator->apply($subject);

        $this->assertTrue($result);
        $this->assertEquals($expectedBlank, $subject->testField);
    }

    public function testValidateBoolSuccess()
    {
        $subject = (object) ['testField' => true];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('bool');
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testCanValidateArray()
    {
        $subject = ['testField' => true];

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
        $subject = (object) ['testField' => 1];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('bool');
        $result = $validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $validator->getFailures());
        $this->assertEquals($expectedMessages, $validator->getFailures()->getMessages());
    }

    public function testAllowBlankValues()
    {
        $subject = (object)['testField' => null];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('bool')->allowBlank();
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testAllowCustomBlankValue()
    {
        $subject = (object)['testField' => 0];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('bool')->allowBlank()->setBlankValues([0]);
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testPreventCustomBlankValue()
    {
        $subject = (object)['testField' => 0];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is('int')->setBlankValues([0]);
        $result = $validator->apply($subject);

        $this->assertFalse($result);
    }

    public function testIsBetween()
    {
        $subject = (object) ['success' => 5,];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('success')->is('between', 1, 10);
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testCustomRulesExample()
    {
        $validateRules = [
            'foo' => function () {
                return new ExampleCustomValidateRule();
            }
        ];
        $sanitizeRules = [
            'foo' => function () {
                return new ExampleCustomSanitizeRule();
            }
        ];

        $factory = new ValidatorFactory($validateRules, $sanitizeRules);
        $validator = $factory->newValidator();

        $subject = (object) [
            'testField' => 'bar'
        ];

        $validator->sanitize('testField')->to('foo');
        $validator->validate('testField')->is('foo');
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }
}
