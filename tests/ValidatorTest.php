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
                'testField should not be blank and validated as bool()'
            ]
        ];
        $subject = (object) ['testField' => 1];

        $this->validator->validate('testField')->is('bool');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessages());
        $this->assertEquals($expectedMessages, $this->validator->getFailures()->getMessages());
    }

    public function testBlankFailureMessage()
    {
        $expectedMessage = [
            'testField' => [
                'testField should not be blank and validated as bool()'
            ]
        ];
        $subject = (object) [];

        $this->validator->validate('testField')->is('bool');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessages());
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testHardRules()
    {
        $expectedMessage = [
            'testField' => [
                'testField should not be blank and validated as int()'
            ]
        ];
        $subject = (object) [];

        $this->validator->validate('testField')->is('int')->asHardRule();
        //this rule should never run
        $this->validator->validate('testField')->is('bool');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testSoftRules()
    {
        $expectedMessage = [
            'testField' => [
                'testField should have sanitized to int()',
                'testField should have sanitized to bool()'
            ]
        ];
        $subject = (object) [];

        $this->validator->sanitize('testField')->to('int')->asSoftRule();
        $this->validator->sanitize('testField')->to('bool');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(2, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }

    public function testHaltingRule()
    {
        $expectedMessage = [
            'testField' => [
                'testField should have sanitized to int()'
            ]
        ];
        $subject = (object) [];

        $this->validator->sanitize('testField')->to('int')->asHaltingRule();
        $this->validator->validate('testField')->is('int');
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

        $this->validator->validate('testField')->is('int');
        $this->validator->setFieldMessage('testField', 'customFieldMessage');
        $result = $this->validator->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $this->validator->getFailures()->getMessagesForField('testField'));
        $this->assertEquals($expectedMessage, $this->validator->getFailures()->getMessages());
    }
}
