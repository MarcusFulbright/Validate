<?php

namespace Mbright\Validation\Rule\Validate;

class Integer
{
    /**
     * Validates that the value represents an integer.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (is_int($value)) {
            return true;
        }

        // otherwise, must be numeric, and must be same as when cast to int
        return is_numeric($value) && $value == (int) $value;
    }
}
