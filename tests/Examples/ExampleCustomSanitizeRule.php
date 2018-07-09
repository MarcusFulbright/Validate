<?php

namespace Mbright\Validation\Tests\Examples;

use Mbright\Validation\Rule\Sanitize\SanitizeRuleInterface;

class ExampleCustomSanitizeRule implements SanitizeRuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = 'foo';

        return true;
    }
}
