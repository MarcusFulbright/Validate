<?php

namespace Mbright\Validation\Rule\Sanitize;

class Integer
{
    /**
     * Converts the field to an integer.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (is_numeric($value)) {
            // we double-cast here to honor scientific notation.
            // (int) 1E5 == 15, but (int) (float) 1E5 == 100000
            $value = (float) $value;
            $subject->$field = (int) $value;

            return true;
        }

        if (!is_string($value)) {
            return false;
        }

        $subject->$field = (int) $subject->$field;

        return true;
    }
}
