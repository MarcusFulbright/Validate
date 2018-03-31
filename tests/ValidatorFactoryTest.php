<?php

namespace Nashphp\Validation\Tests;

use Nashphp\Validation\Failure\FailureCollection;
use Nashphp\Validation\Locator\SanitizeLocator;
use Nashphp\Validation\Locator\ValidationLocator;
use Nashphp\Validation\Validator;
use Nashphp\Validation\ValidatorFactory;
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
