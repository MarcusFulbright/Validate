<?php

namespace Mbright\Validation\Rule\Validate;

class StringVal
{
    /**
     * Validates that the value can be represented as a string.
     *
     * Essentially, this means any scalar value is valid (no arrays, objects, resources, etc). If the $subject is an
     * object and has a __tostring() method, this will validate successfully.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (is_object($value)) {
            return method_exists($value, '__toString');
        }

        return is_scalar($value);
    }
}
