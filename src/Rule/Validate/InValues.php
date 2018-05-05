<?php

namespace Mbright\Validation\Rule\Validate;

class InValues
{
    /**
     * Validates that the value is in a given array.
     *
     * Strict checking is enforced, so a string "1" is not the same as an integer 1.  This helps to avoid matching
     * between 0, false, null, and empty string.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param array $array An array of allowed values.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, array $array): bool
    {
        return in_array($subject->$field, $array, true);
    }
}
