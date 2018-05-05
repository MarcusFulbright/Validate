<?php

namespace Mbright\Validation\Rule\Validate;

class Double
{
    /**
     * Validates that the value represents a float.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (is_float($value)) {
            return true;
        }

        // otherwise, must be numeric, and must be same as when cast to float
        return is_numeric($value) && $value == (float) $value;
    }
}
