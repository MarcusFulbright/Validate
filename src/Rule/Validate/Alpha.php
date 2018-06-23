<?php

namespace Mbright\Validation\Rule\Validate;

class Alpha implements ValidateRuleInterface
{
    /**
     * Validates if the specified field contains only alphabetic characters.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        return is_string($value) && preg_match('/^[\pL\pM]+$/u', $value);
    }
}
