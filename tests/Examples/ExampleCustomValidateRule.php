<?php

namespace Mbright\Validation\Tests\Examples;

class ExampleCustomValidateRule
{
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === 'foo';
    }
}
