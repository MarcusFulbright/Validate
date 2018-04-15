<?php

namespace Mbright\Validation\Tests\Examples;

use Mbright\Validation\Rule\RuleInterface;

class ExampleCustomSanitizeRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = 'foo';

        return true;
    }
}
