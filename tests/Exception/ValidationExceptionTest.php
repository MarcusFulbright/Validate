<?php

namespace Nashphp\Validation\Tests\Exception;

use Nashphp\Validation\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class ValidationExceptionTest extends TestCase
{
    public function testRuleNotMappedException()
    {
        $fakeRuleName = 'fakeRuleName';
        $actual = ValidationException::ruleNotMappedException($fakeRuleName);

        $this->assertInstanceOf(ValidationException::class, $actual);

        $expectedMessage = "Could not find mapping for [$fakeRuleName]";
        $actualMessage = $actual->getMessage();
        $this->assertEquals($expectedMessage, $actualMessage);
    }
}
