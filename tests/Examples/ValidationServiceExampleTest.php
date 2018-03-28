<?php

namespace Nashphp\Validation\Tests\Examples;

use Nashphp\Validation\Failure\FailureCollection;
use Nashphp\Validation\Locator\SanitizeLocator;
use Nashphp\Validation\Locator\ValidationLocator;
use Nashphp\Validation\ValidationService;

class ValidationServiceExampleTest extends \PHPUnit_Framework_TestCase
{
    protected function getValidationLocator(): ValidationLocator
    {
        return new ValidationLocator();
    }

    protected function getSanitizeLocator(): SanitizeLocator
    {
        return new SanitizeLocator();
    }

    protected function getFailureCollection(): FailureCollection
    {
        return new FailureCollection();
    }

    protected function getValidationService(
        ValidationLocator $validationLocator = null,
        SanitizeLocator $sanitizeLocator = null,
        FailureCollection $failureCollection = null
    ): ValidationService {
        $validationLocator =  $validationLocator ?? $this->getValidationLocator();
        $sanitizeLocator = $sanitizeLocator ?? $this->getSanitizeLocator();
        $failureCollection = $failureCollection ?? $this->getFailureCollection();

        return new ValidationService($validationLocator, $sanitizeLocator, $failureCollection);
    }

    public function testSanitizeToBool()
    {
        $subject = new \stdClass();
        $subject->testField = 1;
        $validationService = $this->getValidationService();

        $validationService->sanitize('testField', 'toBool');
        $validationService->apply($subject);

        $this->assertTrue($subject->testField);
    }

    public function testValidateBoolSuccess()
    {
        $subject = new \stdClass();
        $subject->testField = true;

        $validationService = $this->getValidationService();
        $validationService->validate('testField', 'isBool');
        $result = $validationService->apply($subject);

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

        $validationService = $this->getValidationService();
        $validationService->validate('testField', 'isBool');
        $result = $validationService->apply($subject);

        $this->assertFalse($result);
        $this->assertCount(1, $validationService->getFailures());
        $this->assertEquals($expectedMessages, $validationService->getFailures()->getMessages());
    }
}
