<?php

namespace Mbright\Validation\Rule\Validate;

class EqualToField
{
    /**
     * Validates that this value is loosely equal to some other subject field.
     *
     * If the other element does not exist in $subject, or is null, the validation will fail.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $other_field Check against the value of this subject field.
     *
     * @return bool True if the values are equal, false if not equal.
     */
    public function __invoke($subject, $field, $other_field)
    {
        if (!isset($subject->$other_field)) {
            return false;
        }

        return $subject->$field == $subject->$other_field;
    }
}
