<?php

namespace Mbright\Validation\Rule\Validate;

class Str
{
    /**
     * Validates that the value can be represented as a string.
     *
     * Essentially, this means any scalar value is valid (no arrays, objects, resources, etc). If the $subject is an
     * object and has a __toString() method, this will validate successfully.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, $field)
    {
        if (is_object($subject)) {
            return method_exists($subject, '__toString');
        }

        return is_scalar($subject->$field);
    }
}
