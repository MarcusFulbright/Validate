<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class StrlenMax extends AbstractStringCase
{
    /**
     * Validates that a value is no longer than a certain length.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $max The value must have no more than this many
     * characters.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, int $max): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return $this->strlen($value) <= $max;
    }
}
