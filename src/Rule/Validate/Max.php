<?php

namespace Mbright\Validation\Rule\Validate;

class Max
{
    /**
     * Validates that the value is less than than or equal to a maximum.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $max The maximum valid value.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, int $max): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return $value <= $max;
    }
}
