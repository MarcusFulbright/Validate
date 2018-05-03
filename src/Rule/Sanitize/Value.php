<?php

namespace Mbright\Validation\Rule\Sanitize;

class Value
{
    /**
     * Modifies the field value to match another value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $other_value The value to set.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, $field, $otherValue)
    {
        $subject->$field = $otherValue;

        return true;
    }
}
