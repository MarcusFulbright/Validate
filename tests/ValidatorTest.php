<?php

namespace Mbright\Validation\Tests;

use Mbright\Validation\Rule\Sanitize;
use Mbright\Validation\Rule\Validate;
use Mbright\Validation\Validator;
use Mbright\Validation\ValidatorFactory;
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
                'testField should not be blank and validated as Mbright\Validation\Rule\Validate\Boolean()'
            ]
        ];
        $subject = (object) ['testField' => 'notABool'];

        $this->validator->validate('testField')->is(Validate\Boolean::class);
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessages());
        $this->assertEquals($expectedMessages, $this->validator->getFailures()->getMessages());
    }

    public function testBlankFailureMessage()
    {
        $expectedMessage = [
            'testField' => [
                'testField should not be blank and validated as Mbright\Validation\Rule\Validate\Boolean()'
            ]
        ];
        $subject = (object) [];

        $this->validator->validate('testField')->is(Validate\Boolean::class);
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessages());
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testHardRules()
    {
        $expectedMessage = [
            'testField' => [
                'testField should not be blank and validated as Mbright\Validation\Rule\Validate\Integer()'
            ]
        ];
        $subject = (object) [];

        $this->validator->validate('testField')->is(Validate\Integer::class)->asHardRule();
        //this rule should never run
        $this->validator->validate('testField')->is(Validate\Boolean::class);
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testSoftRules()
    {
        $expectedMessage = [
            'testField' => [
                'testField should have sanitized to Mbright\Validation\Rule\Sanitize\Integer()',
                'testField should have sanitized to Mbright\Validation\Rule\Sanitize\Boolean()'
            ]
        ];
        $subject = (object) [];

        $this->validator->sanitize('testField')->to(Sanitize\Integer::class)->asSoftRule();
        $this->validator->sanitize('testField')->to(Sanitize\Boolean::class);
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(2, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testHaltingRule()
    {
        $expectedMessage = [
            'testField' => [
                'testField should have sanitized to Mbright\Validation\Rule\Sanitize\Integer()'
            ]
        ];
        $subject = (object) [];

        $this->validator->sanitize('testField')->to(Sanitize\Integer::class)->asHaltingRule();
        $this->validator->validate('testField')->is(Validate\Integer::class);
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testFieldLevelMessage()
    {
        $expectedMessage = [
            'testField' => [
                'customFieldMessage'
            ]
        ];
        $subject = (object) [];

        $this->validator->validate('testField')->is(Validate\Integer::class);
        $this->validator->setFieldMessage('testField', 'customFieldMessage');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }
}
