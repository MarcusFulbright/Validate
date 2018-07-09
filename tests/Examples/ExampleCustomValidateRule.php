<?php

namespace Mbright\Validation\Tests\Examples;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

class ExampleCustomValidateRule implements ValidateRuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === 'foo';
    }
}
