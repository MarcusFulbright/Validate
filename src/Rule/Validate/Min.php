<?php

namespace Mbright\Validation\Rule\Validate;

class Min
{
    /**
     * Validates that the value is greater than or equal to a minimum.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $min The minimum valid value.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, $field, $min)
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return $value >= $min;
    }
}
