<?php

namespace Nashphp\Validation\Rule\Validate;

class Between
{
    /**
     * Validates that a field's value is between the given min and max.
     *
     * @param $subject
     * @param string $field
     * @param int $min minimum 'floor' value
     * @param int $max maximum 'ceiling' value
     *
     * @return bool
     */
    public function __invoke($subject, string $field, int $min, int $max): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return ($value >= $min && $value <= $max);
    }
}
