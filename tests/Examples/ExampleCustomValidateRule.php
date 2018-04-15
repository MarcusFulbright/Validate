<?php

namespace Mbright\Validation\Tests\Examples;

use Mbright\Validation\Rule\RuleInterface;

class ExampleCustomValidateRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === 'foo';
    }
}
