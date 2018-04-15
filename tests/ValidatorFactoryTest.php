<?php

namespace Mbright\Validation\Tests;

use Mbright\Validation\Failure\FailureCollection;
use Mbright\Validation\Locator\SanitizeLocator;
use Mbright\Validation\Locator\ValidationLocator;
use Mbright\Validation\Validator;
use Mbright\Validation\ValidatorFactory;
use PHPUnit\Framework\TestCase;

class ValidatorFactoryTest extends TestCase
{
    /** @var ValidatorFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new ValidatorFactory();
    }

    public function testNewValidationLocator()
    {
        $actual = $this->factory->newValidationLocator();

        $this->assertInstanceOf(ValidationLocator::class, $actual);
    }

    public function testNewSanitizeLocator()
    {
        $actual = $this->factory->newSanitizeLocator();

        $this->assertInstanceOf(SanitizeLocator::class, $actual);
    }

    public function testNewFailureCollection()
    {
        $actual = $this->factory->newFailureCollection();

        $this->assertInstanceOf(FailureCollection::class, $actual);
    }

    public function testNewValidator()
    {
        $actual = $this->factory->newValidator();

        $this->assertInstanceOf(Validator::class, $actual);
    }
}
