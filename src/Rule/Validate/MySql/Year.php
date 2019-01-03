<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Handles 4 digit years supported by mysql 8.0
 */
class Year implements ValidateRuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (!is_int($value)) {
            return false;
        }

        return $value >= 1901 && $value <= 2155;
    }
}
