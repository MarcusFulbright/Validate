<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class Strlen extends AbstractStringCase
{
    /**
     * Validates that the length of the value is within a given range.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $len The minimum valid length.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, int $len): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return $this->strlen($value) == $len;
    }
}
