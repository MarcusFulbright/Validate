<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class StrlenBetween extends AbstractStringCase
{
    /**
     * Validates that the length of the value is within a given range.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $min The minimum valid length.
     * @param int $max The maximum valid length.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, int $min, int $max): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        $len = $this->strlen($value);

        return ($len >= $min && $len <= $max);
    }
}
