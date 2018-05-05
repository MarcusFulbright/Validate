<?php

namespace Mbright\Validation\Rule\Validate;

class Regex
{
    /**
     * Validates the value against a regular expression.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $expr The regular expression to validate against.
     *
     * @return bool True if the value matches the expression, false if not.
     */
    public function __invoke($subject, string $field, string $expr): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return (bool) preg_match($expr, $value);
    }
}
