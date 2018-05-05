<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class Lowercase extends AbstractStringCase
{
    /**
     * Sanitizes a string to lowercase.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        $subject->$field = $this->strToLower($value);

        return true;
    }
}
