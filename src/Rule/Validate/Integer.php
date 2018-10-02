<?php

namespace Mbright\Validation\Rule\Validate;

class Integer extends AbstractIntegerCase implements ValidateRuleInterface
{
    /**
     * Validates that the value represents an integer.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        return $this->isIntOrNumeric($value);
    }
}
