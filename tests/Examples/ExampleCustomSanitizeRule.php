<?php

namespace Nashphp\Validation\Tests\Examples;

use Nashphp\Validation\Rule\RuleInterface;

class ExampleCustomSanitizeRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = 'foo';

        return true;
    }
}
