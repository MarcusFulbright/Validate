<?php

namespace Mbright\Validation\Rule\Validate;

class Email implements ValidateRuleInterface
{
    /**
     * Validates that the value is an email address
     *
     * @param object $subject The subject to be filtered
     * @param string $field The subject field name
     *
     * @return bool True if valid, false if not
     */
    public function __invoke($subject, string $field): bool
    {
        return filter_var($subject->$field, FILTER_VALIDATE_EMAIL) !== false;
    }
}
