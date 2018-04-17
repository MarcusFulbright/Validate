<?php

namespace Mbright\Validation\Tests\Examples;

class ExampleCustomSanitizeRule
{
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = 'foo';

        return true;
    }
}
