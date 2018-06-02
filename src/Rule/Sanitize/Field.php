<?php

namespace Mbright\Validation\Rule\Sanitize;

class Field
{
    /**
     * Modifies the field value to match that of another field.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $other_field The name of the other subject field.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, $field, $other_field): bool
    {
        // the other field needs to exist and *not* be null
        if (! isset($subject->$other_field)) {
            return false;
        }
        $subject->$field = $subject->$other_field;

        return true;
    }
}
