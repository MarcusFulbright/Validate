<?php

namespace Nashphp\Validation\Rule\Validate;

use Nashphp\Validation\Rule\RuleInterface;

class Integer implements RuleInterface
{
    /**
     * Validates if the field is an integer.
     *
     * Uses the native `is_int()` function.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        return is_int($subject->$field);
    }
}
