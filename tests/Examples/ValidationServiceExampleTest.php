<?php

namespace Nashphp\Validation\Tests\Examples;

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

    protected function getValidationService(
        ValidationLocator $validationLocator= null,
        SanitizeLocator $sanitizeLocator = null
    ): ValidationService {
        $validationLocator =  $validationLocator ?? $this->getValidationLocator();
        $sanitizeLocator = $sanitizeLocator ?? $this->getSanitizeLocator();

        return new ValidationService($validationLocator, $sanitizeLocator);
    }

    public function testSanitizeToBool()
    {
        $subject = new \stdClass();
        $subject->testField = 1;
        $validationService = $this->getValidationService();

        $validationService->sanitize('testField', 'toBool');
        $validationService->applyToSubject($subject);

        $this->assertTrue($subject->testField);
    }
}
