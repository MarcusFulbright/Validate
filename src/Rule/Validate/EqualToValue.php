<?php

namespace Mbright\Validation\Rule\Validate;

class EqualToValue
{
    /**
     * Validates that this value is loosely equal to another value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $otherValue The other value.
     *
     * @return bool True if the values are equal, false if not equal.
     */
    public function __invoke($subject, string $field, string $otherValue): bool
    {
        return $subject->$field == $otherValue;
    }
}
