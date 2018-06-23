<?php

namespace Mbright\Validation\Rule\Validate;

class AlphaDash implements ValidateRuleInterface
{
    /**
     * Validates that the specified field only contains alpha-numeric characters, dashes, and underscores.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        return preg_match('/^[\pL\pM\pN_-]+$/u', $value) > 0;
    }
}
