<?php

namespace Mbright\Validation\Rule\Validate;

class Trim
{
    /**
     * Validates that a value is already trimmed.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $chars The characters to strip.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, string $chars = " \t\n\r\0\x0B"): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return trim($value, $chars) == $value;
    }
}