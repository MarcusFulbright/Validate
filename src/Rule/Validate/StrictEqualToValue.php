<?php

namespace Mbright\Validation\Rule\Validate;

class StrictEqualToValue
{
    /**
     * Validates that this value is strictly equal to another value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $otherValue
     *
     * @return bool True if the values are equal, false if not equal.
     */
    public function __invoke($subject, string $field, $otherValue): bool
    {
        return $subject->$field === $otherValue;
    }
}
