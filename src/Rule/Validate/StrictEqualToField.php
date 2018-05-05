<?php

namespace Mbright\Validation\Rule\Validate;

class StrictEqualToField
{
    /**
     * Validates that this value is strictly equal to some other subject field.
     *
     * If the other element does not exist in $subject, or is null, the validation will fail.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $otherField Check against the value of this element in $subject.
     *
     * @return bool True if the values are equal, false if not equal.
     */
    public function __invoke($subject, string $field, string $otherField): bool
    {
        // the other field needs to exist and *not* be null
        if (! isset($subject->$otherField)) {
            return false;
        }

        return $subject->$field === $subject->$otherField;
    }
}
