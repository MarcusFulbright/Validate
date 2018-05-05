<?php

namespace Mbright\Validation\Rule\Sanitize;

class MatchField
{
    /**
     * Modifies the field value to match that of another field.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $otherField The name of the other subject field.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field, string $otherField): bool
    {
        if (!isset($subject->$otherField)) {
            return false;
        }

        $subject->$field = $subject->$otherField;

        return true;
    }
}
