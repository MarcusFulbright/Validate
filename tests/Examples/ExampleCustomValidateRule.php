<?php

namespace Nashphp\Validation\Tests\Examples;

use Nashphp\Validation\Rule\RuleInterface;

class ExampleCustomValidateRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === 'foo';
    }
}
