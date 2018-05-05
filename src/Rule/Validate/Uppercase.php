<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class Uppercase extends AbstractStringCase
{
    /**
     * Validates that the string is uppercase.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return $this->strtoupper($value) == $value;
    }
}
