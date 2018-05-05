<?php

namespace Mbright\Validation\Rule\Sanitize;

class Between
{
    /**
     * Check that the value is within the given range.
     *
     * If the value is greater than the max, assign it to the max. If it is lower than the min, assign it to the min.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $min The minimum valid value.
     * @param int $max The maximum valid value.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field, int $min, int $max): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        if ($value < $min) {
            $subject->$field = $min;
        }

        if ($value > $max) {
            $subject->$field = $max;
        }


        return true;
    }
}
