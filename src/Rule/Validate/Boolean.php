<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractBooleanCase;

class Boolean extends AbstractBooleanCase
{
    /**
     * Validates that the value is a boolean representation.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        return $this->isTrue($value) || $this->isFalse($value);
    }
}
