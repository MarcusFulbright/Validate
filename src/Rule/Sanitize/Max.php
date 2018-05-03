<?php

namespace Mbright\Validation\Rule\Sanitize;

class Max
{
    /**
     * Sanitizes to maximum value if value is greater than max.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $max The maximum valid value.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, $field, $max)
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        if ($value > $max) {
            $subject->$field = $max;
        }

        return true;
    }
}
