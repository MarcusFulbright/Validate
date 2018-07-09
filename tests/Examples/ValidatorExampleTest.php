<?php

namespace Mbright\Validation\Tests\Examples;

use Mbright\Validation\Rule\Validate;
use Mbright\Validation\Rule\Sanitize;
use Mbright\Validation\ValidatorFactory;
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

        $validator->sanitize('testField')->to(new Sanitize\Boolean());
        $validator->apply($subject);

        $this->assertTrue($subject->testField);
    }

    public function testSanitizeArray()
    {
        $subject = ['testField' => 1];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField')->to(new Sanitize\Boolean());
        $validator->apply($subject);

        $this->assertTrue($subject['testField']);
    }

    public function testSanitizeWithBlankValue()
    {
        $expectedBlank = 'expectedBlankValue';
        $subject = (object) ['testField' => ''];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->sanitize('testField')->to(new Sanitize\Boolean())->usingBlank($expectedBlank);
        $result = $validator->apply($subject);

        $this->assertTrue($result);
        $this->assertEquals($expectedBlank, $subject->testField);
    }

    public function testValidateBoolSuccess()
    {
        $subject = (object) ['testField' => true];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is(new Validate\Boolean());
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testCanValidateArray()
    {
        $subject = ['testField' => true];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is(new Validate\Boolean());
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testValidateBoolFailure()
    {
        $expectedMessages = [
            'testField' => [
                'testField should not be blank and validated as Mbright\Validation\Rule\Validate\Boolean()'
            ]
        ];
        $subject = (object) ['testField' => 'notABool'];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is(new Validate\Boolean());
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

        $validator->validate('testField')->is(new Validate\Boolean())->allowBlank();
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testAllowCustomBlankValue()
    {
        $subject = (object)['testField' => 0];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is(new Validate\Boolean())->allowBlank()->setBlankValues([0]);
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testPreventCustomBlankValue()
    {
        $subject = (object)['testField' => 0];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('testField')->is(new Validate\Integer())->setBlankValues([0]);
        $result = $validator->apply($subject);

        $this->assertFalse($result);
    }

    public function testIsBetween()
    {
        $subject = (object) ['success' => 5,];

        $validatorFactory = new ValidatorFactory();
        $validator = $validatorFactory->newValidator();

        $validator->validate('success')->is(new Validate\Between(1, 10));
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }

    public function testCustomRulesExample()
    {

        $factory = new ValidatorFactory();
        $validator = $factory->newValidator();

        $subject = (object) [
            'testField' => 'bar'
        ];

        $validator->sanitize('testField')->to(new ExampleCustomSanitizeRule());
        $validator->validate('testField')->is(new ExampleCustomValidateRule());
        $result = $validator->apply($subject);

        $this->assertTrue($result);
    }
}
